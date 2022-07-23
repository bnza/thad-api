<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Area;
use App\Entity\Site;
use App\Entity\SU;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'StratigraphicUnitCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdSU',
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
class ViewAppIdSU
{
    #[Groups([
        'read:ViewAppIdSU',
    ])]
    private int $id;

    #[Groups([
        'read:SU',
        'read:ViewAppIdSU',
        'export:Grave',
        'export:SU',
        'export:Pottery',
        'export:Sample',
        'export:Ecofact',
        'export:SmallFind',
        'export:ViewCumulativePotterySheet',
        'read:Sample',
        'read:collection:Pottery',
        'read:Pottery',
        'read:Ecofact',
        'read:SmallFind',
        'read:ViewCumulativePotterySheet',
    ])]
    public string $code;

    public SU $source;

    public function getId(): int
    {
        return $this->id;
    }
}
