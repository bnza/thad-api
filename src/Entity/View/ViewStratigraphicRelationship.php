<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SU;
use App\Entity\Vocabulary\SU\Relationship;
use App\Validator as AppValidator;
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
    shortName: 'StratigraphicRelationship',
    denormalizationContext: [
        'groups' => [
            'write:ViewStratigraphicRelationship',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:ViewStratigraphicRelationship',
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
    message: 'Stratigraphic relationship between given SUs already exists',
    errorPath: 'sxSU',
)]
#[AppValidator\InverseSURelationAbsent]
#[AppValidator\SURelationshipIsNotSelfReferencing]
class ViewStratigraphicRelationship
{
    #[Groups([
        'read:ViewStratigraphicRelationship',
    ])]
    private int $id;

    #[Groups([
        'read:ViewStratigraphicRelationship',
        'write:ViewStratigraphicRelationship',
    ])]
    #[Assert\NotNull]
    public SU $sxSU;

    #[Groups([
        'read:ViewStratigraphicRelationship',
        'write:ViewStratigraphicRelationship',
    ])]
    #[Assert\NotNull]
    public Relationship $relationship;

    #[Groups([
        'read:ViewStratigraphicRelationship',
        'write:ViewStratigraphicRelationship',
    ])]
    #[Assert\NotNull(
        message: 'Related SU is required'
    )]
    public SU $dxSU;

    public function getId(): int
    {
        return $this->id;
    }
}
