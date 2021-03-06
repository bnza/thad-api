<?php

namespace App\Entity\View;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
    ],
    itemOperations: ['get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
        ],
    ],
    shortName: 'Nominative',
    normalizationContext: [
        'groups' => [
            'read:ViewNominative',
        ],
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'name' => 'ipartial',
    ]
)]
class ViewNominative
{
    public string $id;
    #[Groups([
        'read:ViewNominative',
    ])]
    public string $name;
}
