<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
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
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'code',
        'name',
        'description',
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'code' => 'exact',
        'name' => 'exact',
        'description' => 'ipartial',
    ]
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
        'read:Ecofact',
        'read:Site',
        'read:SU',
        'read:Pottery',
    ])]
    private int $id;

    #[Groups([
        'export',
        'read:Area',
        'read:Ecofact',
        'read:Site',
        'read:SU',
        'write:Site',
        'read:Pottery',
    ])]
    #[Assert\NotBlank]
    private string $code;

    #[Groups([
        'export',
        'read:Area',
        'read:Ecofact',
        'read:Site',
        'read:SU',
        'write:Site',
        'read:Pottery',
    ])]
    #[Assert\NotBlank]
    private string $name;

    #[Groups([
        'read:Area',
        'read:Site',
        'write:Site',
    ])]
    private ?string $description;

    private iterable $areas;

    private iterable $stratigraphicUnits;

    public function __construct()
    {
        $this->areas = new ArrayCollection();
        $this->stratigraphicUnits = new ArrayCollection();
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

    public function getStratigraphicUnits(): iterable|ArrayCollection
    {
        return $this->stratigraphicUnits;
    }

    public function setStratigraphicUnits(iterable|ArrayCollection $stratigraphicUnits): Site
    {
        $this->stratigraphicUnits = $stratigraphicUnits;

        return $this;
    }
}
