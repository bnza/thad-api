<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\SU;
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
    shortName: 'MediaObjectStratigraphicUnit',
    denormalizationContext: [
        'groups' => [
            'write:MediaSU',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaSU',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'stratigraphicUnit.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['stratigraphicUnit', 'mediaObject'],
    message: 'Duplicate (media - SU) pair',
    errorPath: 'media_object_id',
)]
class MediaObjectSU
{
    #[Groups([
        'read:MediaSU',
    ])]
    private int $id;

    #[Groups([
        'read:MediaSU',
        'write:MediaSU',
    ])]
    #[Assert\NotNull]
    public SU $stratigraphicUnit;

    #[Groups([
        'read:MediaSU',
        'write:MediaSU',
    ])]
    #[Assert\NotNull]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
