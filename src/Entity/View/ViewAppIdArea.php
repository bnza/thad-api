<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Area;
use App\Entity\Site;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'AreaCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdArea',
        ],
    ],
    routePrefix: 'app_id',
    security: 'is_granted("ROLE_USER")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'site' => 'exact',
        'code' => 'partial',
    ]
)]
class ViewAppIdArea
{
    #[Groups([
        'read:ViewAppIdArea',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:ViewAppIdArea',
        'export:Area',
    ])]
    public string $code;

    public Area $source;

    public Site $site;

    public function getId(): int
    {
        return $this->id;
    }
}
