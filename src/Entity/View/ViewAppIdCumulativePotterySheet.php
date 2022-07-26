<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'CumulativePotterySheetCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdCumulativePotterySheet',
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
class ViewAppIdCumulativePotterySheet
{
    #[Groups([
        'read:ViewAppIdCumulativePotterySheet',
    ])]
    private int $id;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'export:ViewCumulativePotterySheet',
        'read:ViewAppIdCumulativePotterySheet',
    ])]
    public string $code;

    public ViewCumulativePotterySheet $source;

    public function getId(): int
    {
        return $this->id;
    }
}
