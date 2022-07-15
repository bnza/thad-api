<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\Geom\GeomSite;
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
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/sites/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalizationContext' => [
                'groups' => [
                    'export:Site',
                ],
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
        'read:Document',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Site',
        'read:SU',
        'read:Pottery',
        'read:Grave',
        'read:ViewCumulativePotterySheet',
    ])]
    private int $id;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:Document',
        'export:Document',
        'export:SmallFind',
        'export:Ecofact',
        'export:Sample',
        'export:Pottery',
        'read:ViewCumulativePotterySheet',
        'export:SU',
        'read:Area',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Site',
        'read:SU',
        'write:Site',
        'read:Pottery',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    private string $code;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'export:SmallFind',
        'export:Document',
        'export:Ecofact',
        'export:Sample',
        'export:Pottery',
        'export:SU',
        'read:ViewCumulativePotterySheet',
        'read:Area',
        'read:Document',
        'read:Ecofact',
        'read:SmallFind',
        'read:Site',
        'read:SU',
        'write:Site',
        'read:Grave',
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

    public iterable $graves;

    private GeomSite $geom;

    public function __construct()
    {
        $this->areas = new ArrayCollection();
        $this->stratigraphicUnits = new ArrayCollection();
        $this->graves = new ArrayCollection();
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

    public function getGeom(): GeomSite
    {
        return $this->geom;
    }

    public function setGeom(GeomSite $geom): Site
    {
        $this->geom = $geom;

        return $this;
    }
}
