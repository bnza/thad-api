<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SmallFind;
use App\Entity\Vocabulary\Decoration;
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
            'write:DecorationSmallFind',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:DecorationSmallFind',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'smallFind.id' => 'exact',
        'decoration.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['smallFind', 'decoration'],
    message: 'Duplicate decoration for this small find',
    errorPath: 'small_find_id',
)]
class DecorationSmallFind
{
    #[Groups([
        'read:DecorationSmallFind',
    ])]
    private int $id;

    #[Groups([
        'read:DecorationSmallFind',
        'write:DecorationSmallFind',
    ])]
    public SmallFind $smallFind;

    #[Groups([
        'read:SmallFind',
        'read:DecorationSmallFind',
        'write:DecorationSmallFind',
    ])]
    public Decoration $decoration;


    public function getId(): int
    {
        return $this->id;
    }
}
