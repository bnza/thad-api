<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\Vocabulary\PreservationState;
use App\Entity\Vocabulary\Sample\Type;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/sample/export',
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
    denormalizationContext: [
        'groups' => [
            'write:Sample',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Sample',
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
        'compiler',
        'date',
        'note',
        'exhaustive',
        'contaminationRisk',
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'stratigraphicUnit.id' => 'exact',
        'stratigraphicUnit.site.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['stratigraphicUnit', 'number'],
    message: 'ecofact number {{ value }} already exists in this SU',
    errorPath: 'number',
)]
class Sample
{
    #[Groups([
        'read:Sample',
    ])]
    private int $id;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private SU $stratigraphicUnit;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private Type $type;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?PreservationState $preservationState;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private int $number;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private int $quantity = 1;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?string $notes;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $height;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $width;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $length;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $thickness;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $minDiameter;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $maxDiameter;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?float $weight;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private ?string $compiler;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    private bool $selectedForAnalysis = false;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    public ?bool $exhaustive = null;

    #[Groups([
        'read:Sample',
        'write:Sample',
    ])]
    public bool $contaminationRisk = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): Sample
    {
        $this->stratigraphicUnit = $stratigraphicUnit;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): Sample
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): Sample
    {
        $this->number = $number;

        return $this;
    }

    public function getPreservationState(): ?PreservationState
    {
        return $this->preservationState;
    }

    public function setPreservationState(?PreservationState $preservationState): Sample
    {
        $this->preservationState = $preservationState;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): Sample
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Sample
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Sample
    {
        $this->notes = $notes;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): Sample
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): Sample
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): Sample
    {
        $this->length = $length;

        return $this;
    }

    public function getThickness(): ?float
    {
        return $this->thickness;
    }

    public function setThickness(?float $thickness): Sample
    {
        $this->thickness = $thickness;

        return $this;
    }

    public function getMinDiameter(): ?float
    {
        return $this->minDiameter;
    }

    public function setMinDiameter(?float $minDiameter): Sample
    {
        $this->minDiameter = $minDiameter;

        return $this;
    }

    public function getMaxDiameter(): ?float
    {
        return $this->maxDiameter;
    }

    public function setMaxDiameter(?float $maxDiameter): Sample
    {
        $this->maxDiameter = $maxDiameter;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): Sample
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): Sample
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function isSelectedForAnalysis(): bool
    {
        return $this->selectedForAnalysis;
    }

    public function setSelectedForAnalysis(bool $selectedForAnalysis): Sample
    {
        $this->selectedForAnalysis = $selectedForAnalysis;

        return $this;
    }
}