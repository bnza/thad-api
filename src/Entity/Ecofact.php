<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\Vocabulary\Ecofact\Type;
use App\Entity\Vocabulary\PreservationState;
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
            'path' => '/ecofacts/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:Ecofact',
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
            'write:Ecofact',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Ecofact',
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
        'quantity',
        'type.value',
        'material.value',
        'preservationState.value',
        'selectedForAnalysis',
        'length',
        'width',
        'height',
        'thickness',
        'minDiameter',
        'maxDiameter',
        'weight',
        'compiler',
        'date',
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
        'number' => 'exact',
        'quantity' => 'exact',
        'type.id' => 'exact',
        'material.id' => 'exact',
        'preservationState.id' => 'exact',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'notes' => 'ipartial',
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties: [
        'number',
        'quantity',
        'length',
        'width',
        'height',
        'thickness',
        'minDiameter',
        'maxDiameter',
        'weight',
    ]
)]
#[UniqueEntity(
    fields: ['stratigraphicUnit', 'number'],
    message: 'Ecofact number {{ value }} already exists in this SU',
    errorPath: 'number',
)]
class Ecofact
{
    #[Groups([
        'read:Ecofact',
    ])]
    private int $id;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    #[Assert\NotBlank]
    private SU $stratigraphicUnit;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    #[Assert\NotBlank]
    private Type $type;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?PreservationState $preservationState;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    #[Assert\NotBlank]
    private int $number;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private int $quantity = 1;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?string $notes;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $height;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $width;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $length;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $thickness;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $minDiameter;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $maxDiameter;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $weight;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    #[Assert\NotBlank]
    private string $compiler;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private bool $selectedForAnalysis = false;

    public iterable $mediaObjects;

    public function __construct()
    {
        $this->mediaObjects = new ArrayCollection();
    }

    #[Groups([
        'export:Ecofact',
    ])]
    public function getAppId(): ?string
    {
        if (!$this->stratigraphicUnit
            || !$this->number) {
            return null;
        }

        return sprintf(
            '%s.E.%d',
            $this->stratigraphicUnit->getBaseId(), $this->number
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): Ecofact
    {
        $this->stratigraphicUnit = $stratigraphicUnit;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): Ecofact
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): Ecofact
    {
        $this->number = $number;

        return $this;
    }

    public function getPreservationState(): ?PreservationState
    {
        return $this->preservationState;
    }

    public function setPreservationState(?PreservationState $preservationState): Ecofact
    {
        $this->preservationState = $preservationState;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): Ecofact
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Ecofact
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Ecofact
    {
        $this->notes = $notes;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): Ecofact
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): Ecofact
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): Ecofact
    {
        $this->length = $length;

        return $this;
    }

    public function getThickness(): ?float
    {
        return $this->thickness;
    }

    public function setThickness(?float $thickness): Ecofact
    {
        $this->thickness = $thickness;

        return $this;
    }

    public function getMinDiameter(): ?float
    {
        return $this->minDiameter;
    }

    public function setMinDiameter(?float $minDiameter): Ecofact
    {
        $this->minDiameter = $minDiameter;

        return $this;
    }

    public function getMaxDiameter(): ?float
    {
        return $this->maxDiameter;
    }

    public function setMaxDiameter(?float $maxDiameter): Ecofact
    {
        $this->maxDiameter = $maxDiameter;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): Ecofact
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): Ecofact
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function isSelectedForAnalysis(): bool
    {
        return $this->selectedForAnalysis;
    }

    public function setSelectedForAnalysis(bool $selectedForAnalysis): Ecofact
    {
        $this->selectedForAnalysis = $selectedForAnalysis;

        return $this;
    }
}
