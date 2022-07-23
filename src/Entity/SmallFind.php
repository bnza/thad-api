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
use App\Entity\View\ViewAppIdSmallFind;
use App\Entity\Vocabulary\Decoration;
use App\Entity\Vocabulary\Object\Colour;
use App\Entity\Vocabulary\Object\Material;
use App\Entity\Vocabulary\Object\Preservation;
use App\Entity\Vocabulary\Object\Type;
use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\PreservationState;
use App\Entity\Vocabulary\Subperiod;
use App\Validator\CoordinateIsATriple;
use App\Validator\IsValidSubPeriod;
use Doctrine\Common\Collections\ArrayCollection;
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
            'path' => '/small_finds/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:SmallFind',
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
    denormalizationContext: [
        'groups' => [
            'write:SmallFind',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:SmallFind',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")'
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'stratigraphicUnit.area.code',
        'stratigraphicUnit.site.code',
        'stratigraphicUnit.number',
        'number',
        'type.value',
        'material.value',
        'preservation.value',
        'preservationState.value',
        'externalSurfaceColour',
        'internalSurfaceColour',
        'fractureColour',
        'length',
        'width',
        'minWidth',
        'maxWidth',
        'height',
        'thickness',
        'baseDiameter',
        'minDiameter',
        'maxDiameter',
        'weight',
        'compiler',
        'date',
        'summary',
        'description',
        'notes',
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'stratigraphicUnit.id' => 'exact',
        'stratigraphicUnit.site.id' => 'exact',
        'stratigraphicUnit.area.code' => 'exact',
        'stratigraphicUnit.site.code' => 'exact',
        'stratigraphicUnit.year' => 'exact',
        'number' => 'exact',
        'type.id' => 'exact',
        'material.id' => 'exact',
        'preservation.id' => 'exact',
        'preservationState.id' => 'exact',
        'period.id' => 'exact',
        'subperiod.id' => 'exact',
        'externalSurfaceColour.id' => 'exact',
        'internalSurfaceColour.id' => 'exact',
        'fractureColour.id' => 'exact',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'summary' => 'ipartial',
        'notes' => 'ipartial',
        'date' => 'exact',
        'decorations.decoration' => 'exact',
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties: [
        'number',
        'length',
        'width',
        'minWidth',
        'maxWidth',
        'height',
        'thickness',
        'weight',
        'baseDiameter',
        'minDiameter',
        'maxDiameter',
    ]
)]
#[ApiFilter(
    ExistsFilter::class,
    properties: [
        'preservation',
        'preservationState',
        'period',
        'subperiod',
        'externalSurfaceColour',
        'internalSurfaceColour',
        'fractureColour',
    ]
)]
#[ApiFilter(
    DateFilter::class,
    properties: [
        'date',
    ]
)]
#[UniqueEntity(
    fields: ['stratigraphicUnit', 'number'],
    message: 'SmallFind number {{ value }} already exists in this SU',
    errorPath: 'number',
)]
#[CoordinateIsATriple]
#[IsValidSubPeriod]
class SmallFind
{
    #[Groups([
        'read:SmallFind',
    ])]
    private int $id;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\NotNull]
    private SU $stratigraphicUnit;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\NotNull]
    private Type $type;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private Material $material;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Colour $externalSurfaceColour;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Colour $internalSurfaceColour;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Colour $fractureColour;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Period $period = null;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Subperiod $subperiod;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private Preservation $preservation;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?PreservationState $preservationState;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?Decoration $decoration;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\NotNull]
    private int $number;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\Range(
        notInRangeMessage: 'Projected latitude must be between {{ min }} and {{ max }} degree',
        min: 0.00,
        max: 9329005.18,
    )]
    public ?float $coordN = null;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\Range(
        notInRangeMessage: 'Projected longitude must be between {{ min }} and {{ max }} degree',
        min: 166021.44,
        max: 833978.56,
    )]
    public ?float $coordE = null;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    public ?float $coordZ = null;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?string $description;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?string $notes;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?string $summary;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $height;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $width;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $minWidth;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $maxWidth;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $length;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $thickness;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $minDiameter;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $maxDiameter;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $baseDiameter;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    private ?float $weight;

    #[Groups([
        'export:SmallFind',
        'read:SmallFind',
        'write:SmallFind',
    ])]
    #[Assert\NotBlank]
    private string $compiler;

    public iterable $mediaObjects;

    #[Groups([
        'export:SmallFind',
    ])]
    public ViewAppIdSmallFind $appId;

    #[Groups([
        'read:SmallFind',
        'write:SmallFind',
    ])]
    public iterable $decorations;

    public function __construct()
    {
        $this->mediaObjects = new ArrayCollection();
        $this->decorations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): SmallFind
    {
        $this->stratigraphicUnit = $stratigraphicUnit;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): SmallFind
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): SmallFind
    {
        $this->number = $number;

        return $this;
    }

    public function getPreservationState(): ?PreservationState
    {
        return $this->preservationState;
    }

    public function setPreservationState(?PreservationState $preservationState): SmallFind
    {
        $this->preservationState = $preservationState;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): SmallFind
    {
        $this->date = $date;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): SmallFind
    {
        $this->notes = $notes;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): SmallFind
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): SmallFind
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): SmallFind
    {
        $this->length = $length;

        return $this;
    }

    public function getThickness(): ?float
    {
        return $this->thickness;
    }

    public function setThickness(?float $thickness): SmallFind
    {
        $this->thickness = $thickness;

        return $this;
    }

    public function getMinDiameter(): ?float
    {
        return $this->minDiameter;
    }

    public function setMinDiameter(?float $minDiameter): SmallFind
    {
        $this->minDiameter = $minDiameter;

        return $this;
    }

    public function getMaxDiameter(): ?float
    {
        return $this->maxDiameter;
    }

    public function setMaxDiameter(?float $maxDiameter): SmallFind
    {
        $this->maxDiameter = $maxDiameter;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): SmallFind
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCompiler(): string
    {
        return $this->compiler;
    }

    public function setCompiler(string $compiler): SmallFind
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function getMaterial(): Material
    {
        return $this->material;
    }

    public function setMaterial(Material $material): SmallFind
    {
        $this->material = $material;
        return $this;
    }

    public function getExternalSurfaceColour(): ?Colour
    {
        return $this->externalSurfaceColour;
    }

    public function setExternalSurfaceColour(?Colour $externalSurfaceColour): SmallFind
    {
        $this->externalSurfaceColour = $externalSurfaceColour;
        return $this;
    }

    public function getInternalSurfaceColour(): ?Colour
    {
        return $this->internalSurfaceColour;
    }

    public function setInternalSurfaceColour(?Colour $internalSurfaceColour): SmallFind
    {
        $this->internalSurfaceColour = $internalSurfaceColour;
        return $this;
    }

    public function getFractureColour(): ?Colour
    {
        return $this->fractureColour;
    }

    public function setFractureColour(?Colour $fractureColour): SmallFind
    {
        $this->fractureColour = $fractureColour;
        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): SmallFind
    {
        $this->period = $period;
        return $this;
    }

    public function getSubperiod(): ?Subperiod
    {
        return $this->subperiod;
    }

    public function setSubperiod(?Subperiod $subperiod): SmallFind
    {
        if ($subperiod && !$this->period) {
            $this->period = $subperiod->period;
        }
        $this->subperiod = $subperiod;
        return $this;
    }

    public function getPreservation(): Preservation
    {
        return $this->preservation;
    }

    public function setPreservation(Preservation $preservation): SmallFind
    {
        $this->preservation = $preservation;
        return $this;
    }

    public function getDecoration(): ?Decoration
    {
        return $this->decoration;
    }

    public function setDecoration(?Decoration $decoration): SmallFind
    {
        $this->decoration = $decoration;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): SmallFind
    {
        $this->description = $description;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): SmallFind
    {
        $this->summary = $summary;
        return $this;
    }

    public function getMinWidth(): ?float
    {
        return $this->minWidth;
    }

    public function setMinWidth(?float $minWidth): SmallFind
    {
        $this->minWidth = $minWidth;
        return $this;
    }

    public function getMaxWidth(): ?float
    {
        return $this->maxWidth;
    }

    public function setMaxWidth(?float $maxWidth): SmallFind
    {
        $this->maxWidth = $maxWidth;
        return $this;
    }

    public function getBaseDiameter(): ?float
    {
        return $this->baseDiameter;
    }

    public function setBaseDiameter(?float $baseDiameter): SmallFind
    {
        $this->baseDiameter = $baseDiameter;
        return $this;
    }
}
