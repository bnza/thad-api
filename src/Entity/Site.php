<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Controller\SiteExportController;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post',
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => SiteExportController::class,
            'method' => 'GET',
            'path' => '/sites/export',
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
        'patch',
        'delete',
    ],
    denormalizationContext: [
        'groups' => [
            'write:Site',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Site',
        ],
    ],
    security: 'is_granted("ROLE_ADMIN")'
)]
#[UniqueEntity(
    fields: ['code'],
    message: 'Duplicate site code.',
    errorPath: 'code',
)]
#[UniqueEntity(
    fields: ['name'],
    message: 'Duplicate site name.',
    errorPath: 'name',
)]
class Site
{
    #[Groups([
        'read:Area',
        'read:Site',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'export',
        'read:Area',
        'read:Site',
        'read:SU',
        'write:Site',
    ])]
    #[Assert\NotBlank]
    private string $code;

    #[Groups([
        'export',
        'read:Area',
        'read:Site',
        'read:SU',
        'write:Site',
    ])]
    #[Assert\NotBlank]
    private string $name;

    #[Groups([
        'read:Area',
        'read:Site',
        'read:SU',
        'write:Site',
    ])]
    private ?string $description;

    #[ApiSubresource(maxDepth: 1)]
    #[Groups(['read:Site'])]
    private iterable $areas;

    public function __construct()
    {
        $this->areas = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Site
    {
        $this->id = $id;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Site
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Site
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Site
    {
        $this->description = $description;

        return $this;
    }

    public function getAreas(): iterable|ArrayCollection
    {
        return $this->areas;
    }

    public function setAreas(iterable|ArrayCollection $areas): Site
    {
        $this->areas = $areas;

        return $this;
    }
}
