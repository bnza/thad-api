<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
            'write:Area',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Area',
        ],
    ],
    security: 'is_granted("ROLE_ADMIN")'
)]
#[UniqueEntity(
    fields: ['site', 'code'],
    message: 'This area code is already used in that site.',
    errorPath: 'code',
)]
#[UniqueEntity(
    fields: ['site', 'name'],
    message: 'This area name is already used in that site.',
    errorPath: 'name',
)]
class Area
{
    #[Groups([
        'read:Area',
        'read:Site',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:Site',
        'write:Area',
    ])]
    #[Assert\NotBlank]
    private string $code;

    #[Groups([
        'read:Area',
        'read:Site',
        'write:Area',
    ])]
    #[Assert\NotBlank]
    private string $name;

    #[Groups([
        'read:Area',
        'read:Site',
        'write:Area',
    ])]
    private ?string $description;

    #[Groups([
        'read:Area',
        'write:Area',
    ])]
    #[Assert\NotNull]
    private Site $site;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Area
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Area
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Area
    {
        $this->description = $description;

        return $this;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function setSite(Site $site): Area
    {
        $this->site = $site;

        return $this;
    }
}
