<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Sample;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'SampleCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdSample',
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
class ViewAppIdSample
{
    #[Groups([
        'read:ViewAppIdSample',
    ])]
    private int $id;

    #[Groups([
        'read:ViewAppIdSample',
        'export:Sample',
    ])]
    public string $code;

    public Sample $source;

    public function getId(): int
    {
        return $this->id;
    }
}
