<?php

namespace App\Entity\Vocabulary\SU;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    routePrefix: 'vocabulary/su',
)]
class PreservationState
{
    #[Groups([
        'read:Area',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:SU',
    ])]
    private string $value;

    private ?string $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
