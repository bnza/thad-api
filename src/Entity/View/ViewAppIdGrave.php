<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Grave;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'GraveCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdGrave',
        ],
    ],
    routePrefix: 'app_id',
    security: 'is_granted("ROLE_USER")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'appId' => 'end',
    ]
)]
class ViewAppIdGrave
{
    #[Groups([
        'read:ViewAppIdGrave',
    ])]
    private int $id;

    #[Groups([
        'read:ViewAppIdGrave',
        'export:Grave',
        'export:SU',
        'read:SU',
    ])]
    public string $code;

    public Grave $source;

    public function getId(): int
    {
        return $this->id;
    }
}
