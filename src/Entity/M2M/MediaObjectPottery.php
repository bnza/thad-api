<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\Pottery;
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
            'write:MediaPottery',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaPottery',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'pottery.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['pottery', 'mediaObject'],
    message: 'Duplicate media for this pottery',
    errorPath: 'media_object_id',
)]
class MediaObjectPottery
{
    #[Groups([
        'read:MediaPottery',
    ])]
    private int $id;

    #[Groups([
        'read:MediaPottery',
        'write:MediaPottery',
    ])]
    #[Assert\NotNull]
    public Pottery $pottery;

    #[Groups([
        'read:MediaPottery',
        'write:MediaPottery',
    ])]
    #[Assert\NotNull]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
