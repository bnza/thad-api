<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SU;
use App\Entity\Vocabulary\SU\Sequence;
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
    shortName: 'StratigraphicSequence',
    denormalizationContext: [
        'groups' => [
            'write:ViewStratigraphicSequence',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:ViewStratigraphicSequence',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'sxSU' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['sxSU', 'dxSU'],
    message: 'Sequence relationship between given SUs already exists',
    errorPath: 'sxSU',
)]
class ViewStratigraphicSequence
{
    #[Groups([
        'read:ViewStratigraphicSequence',
    ])]
    private int $id;

    #[Groups([
        'read:ViewStratigraphicSequence',
        'write:ViewStratigraphicSequence',
    ])]
    public SU $sxSU;

    #[Groups([
        'read:ViewStratigraphicSequence',
        'write:ViewStratigraphicSequence',
    ])]
    public Sequence $relationship;

    #[Groups([
        'read:ViewStratigraphicSequence',
        'write:ViewStratigraphicSequence',
    ])]
    public SU $dxSU;

    public function getId(): int
    {
        return $this->id;
    }
}
