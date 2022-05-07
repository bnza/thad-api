<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Vocabulary\Ecofact\Type;
use App\Entity\Vocabulary\PreservationState;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'get' => [
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
class Ecofact
{
    #[Groups([
        'read:Ecofact',
    ])]
    private int $id;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private SU $stratigraphicUnit;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private Type $type;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?PreservationState $preservationState;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private int $number;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
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
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $height;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $width;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $length;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $thickness;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $minDiameter;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $maxDiameter;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?float $weight;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private ?string $compiler;

    #[Groups([
        'read:Ecofact',
        'write:Ecofact',
    ])]
    private bool $selectedForAnalysis = false;

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
