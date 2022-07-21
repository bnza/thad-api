<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'post',
        ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'delete',
    ],
    denormalizationContext: [
        'groups' => [
            'write:MediaBuildingRoom',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaBuildingRoom',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'building' => 'exact',
        'room' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['mediaObject', 'building', 'room'],
    message: 'Duplicate building/room for this media',
    errorPath: 'building',
)]
class MediaObjectBuildingRoom
{
    #[Groups([
        'write:MediaBuildingRoom',
        'read:MediaBuildingRoom',
        'read:Document',
    ])]
    private int $id;


    #[Groups([
        'write:MediaBuildingRoom',
        'read:MediaBuildingRoom',
        'read:Document',
    ])]
    public MediaObject $mediaObject;

    #[Groups([
        'write:MediaBuildingRoom',
        'read:MediaBuildingRoom',
        'read:Document',
    ])]
    #[Assert\NotNull]
    #[Assert\Positive]
    public int $building;

    #[Groups([
        'write:MediaBuildingRoom',
        'read:MediaBuildingRoom',
        'read:Document',
    ])]
    #[Assert\Length(min: 1, max: 2)]
    #[Assert\Regex('/^[A-Z]*$/')]
    public ?string $room;


    public function getId(): int
    {
        return $this->id;
    }
}
