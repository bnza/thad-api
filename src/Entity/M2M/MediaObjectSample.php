<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\Sample;
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
            'write:MediaSample',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaSample',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'sample.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['sample', 'mediaObject'],
    message: 'Duplicate media for this sample',
    errorPath: 'media_object_id',
)]
class MediaObjectSample
{
    #[Groups([
        'read:MediaSample',
    ])]
    private int $id;

    #[Groups([
        'read:MediaSample',
        'write:MediaSample',
    ])]
    public Sample $sample;

    #[Groups([
        'read:MediaSample',
        'write:MediaSample',
    ])]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
