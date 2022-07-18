<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\Geom\GeomSU;
use App\Entity\View\ViewCumulativePotterySheet;
use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\PreservationState;
use App\Entity\Vocabulary\SU\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/stratigraphic_units/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:SU',
                ],
            ],
            'security' => 'is_granted("ROLE_USER")',
        ],
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'patch' => null,
        'delete' => null,
    ],
    shortName: 'StratigraphicUnit',
    denormalizationContext: [
        'groups' => [
            'write:SU',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:SU',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'site.id' => 'exact',
        'area.id' => 'exact',
        'area.code' => 'exact',
        'site.code' => 'exact',
        'number' => 'exact',
        'year' => 'exact',
        'areaSupervisor' => 'ipartial',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'interpretation' => 'ipartial',
        'summary' => 'ipartial',
        'period.id' => 'exact',
        'preservationState.id' => 'exact',
        'type.id' => 'exact',
        'grave.id' => 'exact',
        'building' => 'exact',
        'buildingSubPhase' => 'exact',
        'room' => 'exact',
        'phase' => 'exact',
        'subPhase' => 'exact',
        'date' => 'exact',
        'relations.dxSU' => 'exact',
        'relations.relationship' => 'exact',
        'sequences.dxSU' => 'exact',
        'sequences.relationship' => 'exact',
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties: [
        'bottomElevation',
        'topElevation',
        'number',
        'year',
    ]
)]
#[ApiFilter(
    DateFilter::class,
    properties: [
        'date',
    ]
)]
#[ApiFilter(
    ExistsFilter::class,
    properties: [
        'preservationState',
        'period',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'area.code',
        'site.code',
        'year',
        'number',
        'areaSupervisor',
        'bottomElevation',
        'compiler',
        'date',
        'description',
        'interpretation',
        'preservationState.value',
        'summary',
        'topElevation',
        'type.value',
        'period.code',
        'subperiod.value',
        'grave.number',
        'building',
        'room',
        'phase',
    ]
)]
#[UniqueEntity(
    fields: ['site', 'number'],
    message: 'SU {{ value }} already exists in this site',
    errorPath: 'number',
)]
class SU
{
    #[Groups([
        'read:Area',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:SU',
        'read:ViewStratigraphicSequence',
        'read:ViewStratigraphicRelationship',
        'read:ViewCumulativePotterySheet',
        'read:Pottery',
        'read:MediaSU',
        'read:Grave',
    ])]
    private int $id;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:MediaSU',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:SU',
        'read:ViewStratigraphicSequence',
        'read:ViewStratigraphicRelationship',
        'read:ViewCumulativePotterySheet',
        'read:Pottery',
        'write:SU',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $number;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'export:SmallFind',
        'export:Ecofact',
        'export:Sample',
        'export:Pottery',
        'export:SU',
        'read:SU',
        'write:SU',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Pottery',
        'read:ViewCumulativePotterySheet',
        'read:Grave',
    ])]
    public Site $site;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Pottery',
        'read:ViewCumulativePotterySheet',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'SU excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    public int $year;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'export:SmallFind',
        'export:Ecofact',
        'export:Sample',
        'export:Pottery',
        'export:SU',
        'read:SU',
        'write:SU',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Pottery',
        'read:ViewCumulativePotterySheet',
    ])]
    #[Assert\NotBlank]
    private Area $area;

    private GeomSU $geom;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    public ?Period $period;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
        'read:Pottery',
    ])]
    #[Assert\NotNull]
    public \DateTimeImmutable $date;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?string $description;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?string $interpretation;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?string $summary;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\NotBlank]
    public Type $type;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?PreservationState $preservationState;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?float $topElevation;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?float $bottomElevation;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\NotBlank]
    public string $compiler;

    #[Groups([
        'export:SU',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    public ?string $areaSupervisor;

    #[Groups([
        'read:SU',
    ])]
    public ?ViewCumulativePotterySheet $cumulativePotterySheet;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    public ?Grave $grave;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\Positive]
    public ?int $building;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Regex('/^[a-z]*$/')]
    public ?string $buildingSubPhase;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\Regex('/^[A-Z]*$/')]
    public ?string $room;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    public ?int $phase;

    #[Groups([
        'export:SU',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Regex('/^[a-z]*$/')]
    public ?string $subPhase;

    private iterable $relations;

    private iterable $inverseRelations;

    private iterable $sequences;

    private iterable $inverseSequences;

    private iterable $potteries;

    private iterable $ecofacts;

    private iterable $smallFinds;

    private iterable $mediaObjects;

    public function __construct()
    {
        $this->relations = new ArrayCollection();
        $this->inverseRelations = new ArrayCollection();
        $this->sequences = new ArrayCollection();
        $this->inverseSequences = new ArrayCollection();
        $this->potteries = new ArrayCollection();
        $this->ecofacts = new ArrayCollection();
        $this->smallFinds = new ArrayCollection();
        $this->mediaObjects = new ArrayCollection();
    }

    #[Groups([
        'export:Grave',
        'export:SU',
        'export:Pottery',
        'export:Sample',
        'export:Ecofact',
        'export:SmallFind',
        'export:ViewCumulativePotterySheet',
        'read:Sample',
        'read:Pottery',
        'read:Ecofact',
        'read:SmallFind',
        'read:ViewCumulativePotterySheet',
    ])]
    public function getAppId(): ?string
    {
        if (!$this->site
        || !$this->year
        || !$this->number) {
            return null;
        }
        return sprintf("%s.%d.SU.%'.05d", $this->site->getCode(), substr($this->year, 2), $this->number);
    }

    public function getBaseId(): ?string
    {
        if (!$this->site
            || !$this->year
            || !$this->number) {
            return null;
        }
        return sprintf("%s.%d.%'.05d", $this->site->getCode(), substr($this->year, 2), $this->number);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): SU
    {
        $this->site = $area->site;
        $this->area = $area;
        return $this;
    }

    public function getRelations(): iterable|ArrayCollection
    {
        return $this->relations;
    }

    public function setRelations(iterable|ArrayCollection $relations): SU
    {
        $this->relations = $relations;

        return $this;
    }

    public function getInverseRelations(): iterable|ArrayCollection
    {
        return $this->inverseRelations;
    }

    public function setInverseRelations(iterable|ArrayCollection $inverseRelations): SU
    {
        $this->inverseRelations = $inverseRelations;

        return $this;
    }

    public function getPotteries(): iterable|ArrayCollection
    {
        return $this->potteries;
    }

    public function setPotteries(iterable|ArrayCollection $potteries): SU
    {
        $this->potteries = $potteries;

        return $this;
    }

    public function getEcofacts(): iterable|ArrayCollection
    {
        return $this->ecofacts;
    }

    public function setEcofacts(iterable|ArrayCollection $ecofacts): SU
    {
        $this->ecofacts = $ecofacts;

        return $this;
    }

    public function getSmallFinds(): iterable|ArrayCollection
    {
        return $this->smallFinds;
    }

    public function setSmallFinds(iterable|ArrayCollection $smallFinds): SU
    {
        $this->smallFinds = $smallFinds;

        return $this;
    }

    public function getMediaObjects(): ArrayCollection
    {
        return $this->mediaObjects;
    }

    public function setMediaObjects(ArrayCollection $mediaObjects): void
    {
        $this->mediaObjects = $mediaObjects;
    }

    public function getSequences(): iterable|ArrayCollection
    {
        return $this->sequences;
    }

    public function setSequences(iterable|ArrayCollection $sequences): SU
    {
        $this->sequences = $sequences;

        return $this;
    }

    public function getInverseSequences(): iterable|ArrayCollection
    {
        return $this->inverseSequences;
    }

    public function setInverseSequences(iterable|ArrayCollection $inverseSequences): SU
    {
        $this->inverseSequences = $inverseSequences;

        return $this;
    }

    public function ensureSite(LifecycleEventArgs $event)
    {
        if (isset($this->site)) {
            /** @var SU $entity */
            $entity = $event->getEntity();

            $entity->site = $entity->area->site;
        }
    }
}
