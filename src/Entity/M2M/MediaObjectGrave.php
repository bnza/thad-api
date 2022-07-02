<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\Grave;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

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
            'write:MediaGrave',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaGrave',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'grave.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['grave', 'mediaObject'],
    message: 'Duplicate (media - grave) pair',
    errorPath: 'media_object_id',
)]
class MediaObjectGrave
{
    #[Groups([
        'read:MediaGrave',
    ])]
    private int $id;

    #[Groups([
        'read:MediaGrave',
        'write:MediaGrave',
    ])]
    public Grave $grave;

    #[Groups([
        'read:MediaGrave',
        'write:MediaGrave',
    ])]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
