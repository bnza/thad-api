<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\SUExportController;
use App\Entity\Vocabulary\SU\PreservationState;
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
            'controller' => SUExportController::class,
            'method' => 'GET',
            'path' => '/stratigraphic_units/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'groups' => [
                'export',
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
        'area.site.code' => 'exact',
        'areaSupervisor' => 'ipartial',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'interpretation' => 'ipartial',
        'preservationState.value' => 'exact',
        'summary' => 'ipartial',
        'type.value' => 'exact',
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties: [
        'bottomElevation',
        'topElevation',
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
        'type',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'area.code',
        'site.code',
        'square',
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
        'read:SU',
        'read:ViewStratigraphicRelationship',
        'read:Pottery',
    ])]
    private int $id;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'read:ViewStratigraphicRelationship',
        'read:Pottery',
        'write:SU',
    ])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private int $number;

    #[Groups([
        'export',
        'read:SU',
        'write:SU',
        'read:Pottery',
    ])]
    private Site $site;

    #[Groups([
        'export',
        'read:SU',
        'write:SU',
        'read:Pottery',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'SU excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    private int $year;

    #[Groups([
        'export',
        'read:SU',
        'write:SU',
        'read:Pottery',
    ])]
    #[Assert\NotBlank]
    private Area $area;

    #[Groups([
        'export',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\Regex(
        pattern: '/^[[:upper:]]+[[:digit:]]+$/',
        message: 'Square identifier must be one or more capital letters followed by one or more digit (eg. B2, AZ12)',
    )]
    private ?string $square;

    #[Groups([
        'export',
        'read:SU',
        'write:SU',
        'read:Pottery',
    ])]
    #[Assert\NotNull]
    private \DateTimeImmutable $date;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $description;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $interpretation;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $summary;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    #[Assert\NotBlank]
    private Type $type;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?PreservationState $preservationState;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?float $topElevation;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?float $bottomElevation;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $compiler;

    #[Groups([
        'export',
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $areaSupervisor;

    private iterable $relations;

    private iterable $inverseRelations;

    private iterable $potteries;

    public function __construct()
    {
        $this->relations = new ArrayCollection();
        $this->inverseRelations = new ArrayCollection();
        $this->potteries = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): SU
    {
        $this->number = $number;

        return $this;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function setSite(Site $site): SU
    {
        $this->site = $site;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): SU
    {
        $this->year = $year;
        return $this;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function getSquare(): ?string
    {
        return $this->square;
    }

    public function setSquare(?string $square): SU
    {
        $this->square = $square;
        return $this;
    }

    public function setArea(Area $area): SU
    {
        $this->area = $area;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): SU
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): SU
    {
        $this->description = $description;

        return $this;
    }

    public function getInterpretation(): ?string
    {
        return $this->interpretation;
    }

    public function setInterpretation(?string $interpretation): SU
    {
        $this->interpretation = $interpretation;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): SU
    {
        $this->summary = $summary;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): SU
    {
        $this->type = $type;

        return $this;
    }

    public function getPreservationState(): ?PreservationState
    {
        return $this->preservationState;
    }

    public function setPreservationState(?PreservationState $preservationState): SU
    {
        $this->preservationState = $preservationState;

        return $this;
    }

    public function getTopElevation(): ?float
    {
        return $this->topElevation;
    }

    public function setTopElevation(?float $topElevation): SU
    {
        $this->topElevation = $topElevation;

        return $this;
    }

    public function getBottomElevation(): ?float
    {
        return $this->bottomElevation;
    }

    public function setBottomElevation(?float $bottomElevation): SU
    {
        $this->bottomElevation = $bottomElevation;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): SU
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function getAreaSupervisor(): ?string
    {
        return $this->areaSupervisor;
    }

    public function setAreaSupervisor(?string $areaSupervisor): SU
    {
        $this->areaSupervisor = $areaSupervisor;

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

    public function ensureSite(LifecycleEventArgs $event)
    {
        /** @var SU $entity */
        $entity = $event->getEntity();

        $entity->setSite($entity->getArea()->getSite());
    }
}
