<?php

namespace App\Entity\Vocabulary;

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
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    private int $id;

    #[Groups([
        'export:Grave',
        'export:SmallFind',
        'export:Ecofact',
        'export:Sample',
        'export:SU',
        'read:Area',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
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
