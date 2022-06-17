<?php

namespace App\Entity\Vocabulary\Sample;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    shortName: 'SampleType',
    routePrefix: 'vocabulary/sample'
)]
class Type
{
    #[Groups([
        'read:Sample',
    ])]
    private string $id;

    #[Groups([
        'export:Sample',
        'read:Sample',
    ])]
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
