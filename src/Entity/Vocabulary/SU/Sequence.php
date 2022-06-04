<?php

namespace App\Entity\Vocabulary\SU;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get',
    ],
    normalizationContext: [
        'groups' => [
            'read:SU:sequence',
        ],
    ],
    routePrefix: 'vocabulary/su',
)]
class Sequence
{
    #[Groups([
        'read:SU:sequence',
    ])]
    public string $id;

    #[Groups([
        'read:SU:sequence',
    ])]
    public string $value;

    #[Groups([
        'read:SU:sequence',
    ])]
    public Sequence $invertedBy;

    #[Groups([
        'read:SU:sequence',
    ])]
    public ?string $description;
}
