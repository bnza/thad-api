<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\MediaObject;
use App\Entity\SmallFind;
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
            'write:MediaSmallFind',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:MediaSmallFind',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'smallFind.id' => 'exact',
        'mediaObject.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['smallFind', 'mediaObject'],
    message: 'Duplicate media for this pottery',
    errorPath: 'media_object_id',
)]
class MediaObjectSmallFind
{
    #[Groups([
        'read:MediaSmallFind',
    ])]
    private int $id;

    #[Groups([
        'read:MediaSmallFind',
        'write:MediaSmallFind',
    ])]
    #[Assert\NotNull]
    public SmallFind $smallFind;

    #[Groups([
        'read:MediaSmallFind',
        'write:MediaSmallFind',
    ])]
    #[Assert\NotNull]
    public MediaObject $mediaObject;


    public function getId(): int
    {
        return $this->id;
    }
}
