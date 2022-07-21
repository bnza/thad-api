<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\View\ViewAppIdDocument;
use App\Entity\Vocabulary\Document\Type;
use Doctrine\ORM\Event\LifecycleEventArgs;
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
            'path' => '/documents/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:Document',
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
            'write:Document',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Document',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'site.id' => 'exact',
        'area.id' => 'exact',
        'area.code' => 'exact',
        'area.site.code' => 'exact',
        'areaSupervisor' => 'ipartial',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'interpretation' => 'ipartial',
        'summary' => 'ipartial',
        'type.id' => 'exact',
        'creator' => 'ipartial',
        'date' => 'exact',
        'mediaObject.buildingRooms.building' => 'exact',
        'mediaObject.buildingRooms.room' => 'exact',
        'mediaObject.stratigraphicUnits.stratigraphicUnit.id' => 'exact',
        'mediaObject.graves.grave.id' => 'exact',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'stratigraphicUnit.area.code',
        'stratigraphicUnit.site.code',
        'year',
        'number',
        'type.value',
        'compiler',
        'areaSupervisor',
        'creator',
        'date',
        'description',
        'interpretation',
        'summary',
        'date',
    ]
)]
#[ApiFilter(
    DateFilter::class,
    properties: [
        'date',
    ]
)]
#[UniqueEntity(
    fields: ['mediaObject'],
    message: 'Duplicate media',
    errorPath: 'mediaObject',
)]
#[UniqueEntity(
    fields: ['site', 'number'],
    message: 'Document {{ value }} already exists in this site',
    errorPath: 'number',
)]
class Document
{
    #[Groups([
        'read:Document',
        'read:SU',
        'read:MediaBuildingRoom',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    private int $id;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
        'read:SU',
    ])]
    #[Assert\NotNull]
    public int $number;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'SU excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    public int $year;

    #[Groups([
        'export:Document',
        'read:Document',
    ])]
    private Site $site;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    private Area $area;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public Type $type;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public MediaObject $mediaObject;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $description;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $interpretation;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    public ?string $summary;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    public ?string $areaSupervisor;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $creator;

    #[Groups([
        'export:Document',
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public \DateTimeImmutable $date;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Positive(),
    ])]
    public array $buildings = [];

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Length(max: 2),
        new Assert\Regex('/^[A-Z]*$/'),
    ])]
    public array $rooms = [];

    #[Groups([
        'export:Document',
        'read:Document',
        'read:MediaBuildingRoom',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public ViewAppIdDocument $appId;


    public function getId(): int
    {
        return $this->id;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): Document
    {
        $this->area = $area;
        $this->site = $area->site;

        return $this;
    }

    public function ensureId(LifecycleEventArgs $event)
    {
        if (!isset($this->id)) {
            $this->id = $this->mediaObject->getId();
        }
    }
}
