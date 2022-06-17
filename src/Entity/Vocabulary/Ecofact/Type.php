<?php

namespace App\Entity\Vocabulary\Ecofact;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    shortName: 'EcofactType',
    routePrefix: 'vocabulary/ecofact'
)]
class Type
{
    #[Groups([
        'read:Ecofact',
    ])]
    private string $id;

    #[Groups([
        'export:Ecofact',
        'read:Ecofact',
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
