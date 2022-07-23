<?php

namespace App\Entity\M2M;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Pottery;
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
            'write:DecorationPottery',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:DecorationPottery',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'pottery.id' => 'exact',
        'decoration.id' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['pottery', 'decoration'],
    message: 'Duplicate decoration for this pottery',
    errorPath: 'decoration_id',
)]
class DecorationPottery
{
    #[Groups([
        'read:DecorationPottery',
    ])]
    private int $id;

    #[Groups([
        'read:DecorationPottery',
        'write:DecorationPottery',
    ])]
    public Pottery $pottery;

    #[Groups([
        'read:collection:Pottery',
        'read:Pottery',
        'read:DecorationPottery',
        'write:DecorationPottery',
    ])]
    public Decoration $decoration;


    public function getId(): int
    {
        return $this->id;
    }
}
