<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\View\ViewAppIdGrave;
use App\Entity\Vocabulary\Grave\Deposition;
use App\Entity\Vocabulary\Grave\Ritual;
use App\Entity\Vocabulary\Grave\Type;
use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\PreservationState;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post',
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/graves/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:Grave',
                ],
            ],
            'security' => 'is_granted("ROLE_USER")',
        ],
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'patch',
        'delete',
    ],
    denormalizationContext: [
        'groups' => [
            'write:Grave',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Grave',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
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
        'summary' => 'ipartial',
        'preservationState.id' => 'exact',
        'period.id' => 'exact',
        'preservation.id' => 'exact',
        'type.id' => 'exact',
        'date' => 'exact',
        'earlierThan.id' => 'exact',
        'laterThan.id' => 'exact',
        'stratigraphicUnits.id' => 'exact',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'area.code',
        'site.code',
        'stratigraphicUnit.number',
        'number',
        'building',
        'buildingSubPhase',
        'room',
        'phase',
        'subPhase',
        'compiler',
        'description',
        'interpretation',
        'summary',
        'type.value',
        'period.code',
        'deposition.value',
        'ritual.value',
        'date',
    ]
)]
#[ApiFilter(
    ExistsFilter::class,
    properties: [
        'preservationState',
        'period',
        'deposition',
        'ritual',
        'earlierThan',
        'laterThan',
    ]
)]
#[ApiFilter(
    DateFilter::class,
    properties: [
        'date',
    ]
)]
#[UniqueEntity(
    fields: ['site', 'number'],
    message: 'Grave {{ value }} already exists in this site',
    errorPath: 'number',
)]
class Grave
{
    #[Groups([
        'read:MediaGrave',
        'read:Grave',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'export:Grave',
        'read:MediaGrave',
        'write:Grave',
        'read:Grave',
        'read:SU',
    ])]
    #[Assert\NotNull]
    public int $number;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'Grave excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    public int $year;

    #[Assert\NotNull]
    public iterable $stratigraphicUnits;

    #[Groups([
        'export:Grave',
        'read:Grave',
    ])]
    private Site $site;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    private Area $area;

    #[Groups([
        'export:Grave',
        'read:Grave',
        'write:Grave',
    ])]
    public ?Period $period;

    #[Groups([
        'export:Grave',
        'read:Grave',
        'write:Grave',
    ])]
    public ?PreservationState $preservationState;

    #[Groups([
        'export:Grave',
        'read:Grave',
        'write:Grave',
    ])]
    public ?Deposition $deposition;

    #[Groups([
        'export:Grave',
        'read:Grave',
        'write:Grave',
    ])]
    public ?Ritual $ritual;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    public Type $type;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $earlierThan;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $laterThan;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?float $topElevation;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?float $bottomElevation;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $alignment;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $description;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $interpretation;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $summary;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $areaSupervisor;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    public string $compiler;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    public \DateTimeImmutable $date;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\Positive]
    public ?int $building;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Regex('/^[a-z]*$/')]
    public ?string $buildingSubPhase;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\Regex('/^[A-Z]*$/')]
    public ?string $room;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\Positive]
    public ?int $phase;

    #[Groups([
        'export:Grave',
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\Length(
        min: 1,
        max: 1
    )]
    #[Assert\Regex('/^[a-z]*$/')]
    public ?string $subPhase;

    public iterable $mediaObjects;

    #[Groups([
        'export:Grave',
        'export:SU',
        'read:SU',
    ])]
    public ViewAppIdGrave $appId;

    public function __construct()
    {
        $this->stratigraphicUnits = new ArrayCollection();
        $this->mediaObjects = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): Grave
    {
        $this->area = $area;
        $this->site = $area->site;

        return $this;
    }
}
