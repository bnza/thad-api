<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Pottery;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'PotteryCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdPottery',
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
class ViewAppIdPottery
{
    #[Groups([
        'read:ViewAppIdPottery',
    ])]
    private int $id;

    #[Groups([
        'read:ViewAppIdPottery',
        'export:Pottery',
    ])]
    public string $code;

    public Pottery $source;

    public function getId(): int
    {
        return $this->id;
    }
}
