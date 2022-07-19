<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Document;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get',
    ],
    itemOperations: [
        'get',
    ],
    shortName: 'DocumentCode',
    normalizationContext: [
        'groups' => [
            'read:ViewAppIdDocument',
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
class ViewAppIdDocument
{
    #[Groups([
        'read:ViewAppIdDocument',
    ])]
    private int $id;

    #[Groups([
        'read:ViewAppIdDocument',
        'export:Document',
        'read:Document',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public string $code;

    public Document $source;

    public function getId(): int
    {
        return $this->id;
    }
}
