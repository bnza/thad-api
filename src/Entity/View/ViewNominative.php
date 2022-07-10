<?php

namespace App\Entity\View;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

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
    shortName: 'Nominative'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'name' => 'ipartial',
    ]
)]
class ViewNominative
{
    public string $name;
}
