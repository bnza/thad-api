<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/areas/export',
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
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'site.id' => 'exact',
        'site.code' => 'exact',
        'site.name' => 'ipartial',
        'code' => 'exact',
        'name' => 'ipartial',
        'description' => 'ipartial',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'site.code',
        'code',
        'name',
        'description',
    ]
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
        'read:Document',
        'read:Grave',
        'read:Area',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Site',
        'read:SU',
        'read:Pottery',
        'read:ViewCumulativePotterySheet',
    ])]
    private int $id;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'export:SmallFind',
        'export:Ecofact',
        'export:Sample',
        'export:Pottery',
        'export:SU',
        'read:Area',
        'read:Document',
        'read:Grave',
        'read:Ecofact',
        'read:Sample',
        'read:SmallFind',
        'read:Site',
        'read:SU',
        'write:Area',
        'read:Pottery',
        'read:ViewCumulativePotterySheet',
    ])]
    #[Assert\NotBlank]
    private string $code;

    #[Groups([
        'read:Area',
        'read:Document',
        'read:Ecofact',
        'read:SmallFind',
        'read:Grave',
        'read:Site',
        'read:SU',
        'write:Area',
        'read:Pottery',
    ])]
    #[Assert\NotBlank]
    private string $name;

    #[Groups([
        'read:Area',
        'read:Site',
        'read:SU',
        'write:Area',
    ])]
    private ?string $description;

    #[Groups([
        'read:Area',
        'write:Area',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    private Site $site;

    private iterable $stratigraphicUnits;

    public iterable $graves;

    public function __construct()
    {
        $this->stratigraphicUnits = new ArrayCollection();
        $this->graves = new ArrayCollection();
    }

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

    public function getStratigraphicUnits(): iterable|ArrayCollection
    {
        return $this->stratigraphicUnits;
    }

    public function setStratigraphicUnits(iterable|ArrayCollection $stratigraphicUnits): Area
    {
        $this->stratigraphicUnits = $stratigraphicUnits;

        return $this;
    }
}
