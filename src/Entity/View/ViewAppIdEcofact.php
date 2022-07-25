<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Ecofact;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'EcofactCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdEcofact',
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
class ViewAppIdEcofact
{
    #[Groups([
        'read:ViewAppIdEcofact',
    ])]
    private int $id;

    #[Groups([
        'read:Ecofact',
        'read:ViewAppIdEcofact',
        'export:Ecofact',
    ])]
    public string $code;

    public Ecofact $source;

    public function getId(): int
    {
        return $this->id;
    }
}
