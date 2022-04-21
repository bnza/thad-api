<?php

namespace App\Entity\Vocabulary\SU;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get',
    ],
    normalizationContext: [
        'groups' => [
            'read:SU:relationship',
        ],
    ],
    routePrefix: 'vocabulary/su',
)]
class Relationship
{
    #[Groups([
        'read:SU:relationship',
    ])]
    private string $id;

    #[Groups([
        'read:SU:relationship',
    ])]
    private string $value;

    #[Groups([
        'read:SU:relationship',
    ])]
    private Relationship $invertedBy;

    #[Groups([
        'read:SU:relationship',
    ])]
    private ?string $description;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Relationship
    {
        $this->id = $id;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): Relationship
    {
        $this->value = $value;

        return $this;
    }

    public function getInvertedBy(): Relationship
    {
        return $this->invertedBy;
    }

    public function setInvertedBy(Relationship $invertedBy): Relationship
    {
        $this->invertedBy = $invertedBy;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Relationship
    {
        $this->description = $description;

        return $this;
    }
}
