<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
class SU
{
    #[Groups([
        'read:Area',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private int $number;

    #[Groups([
        'read:SU',
        'write:SU',
    ])]
    private Area $area;

    #[Groups([
        'read:SU',
        'write:SU',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $description;

    #[Groups([
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $interpretation;

    #[Groups([
        'read:Area',
        'read:SU',
        'write:SU',
    ])]
    private ?string $summary;

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

    public function getArea(): Area
    {
        return $this->area;
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
}
