<?php

namespace App\Entity\Vocabulary\Object;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    shortName: 'ObjectColour',
    routePrefix: 'vocabulary/object'
)]
class Colour
{
    private string $id;

    private string $value;

    private ?string $description;

    public function getId(): string
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