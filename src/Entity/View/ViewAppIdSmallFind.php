<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SmallFind;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'SmallFindCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdSmallFind',
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
class ViewAppIdSmallFind
{
    #[Groups([
        'read:ViewAppIdSmallFind',
    ])]
    private int $id;

    #[Groups([
        'read:ViewAppIdSmallFind',
        'export:SmallFind',
    ])]
    public string $code;

    public SmallFind $source;

    public function getId(): int
    {
        return $this->id;
    }
}
