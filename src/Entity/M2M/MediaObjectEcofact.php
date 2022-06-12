<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\Ecofact;
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
            'write:MediaEcofact',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaEcofact',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'ecofact.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['ecofact', 'mediaObject'],
    message: 'Duplicate media for this ecofact',
    errorPath: 'media_object_id',
)]
class MediaObjectEcofact
{
    #[Groups([
        'read:MediaEcofact',
    ])]
    private int $id;

    #[Groups([
        'read:MediaEcofact',
        'write:MediaEcofact',
    ])]
    public Ecofact $ecofact;

    #[Groups([
        'read:MediaEcofact',
        'write:MediaEcofact',
    ])]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
