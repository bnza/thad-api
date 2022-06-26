<?php

namespace App\Entity\Vocabulary\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    shortName: 'DocumentType',
    routePrefix: 'vocabulary/document'
)]
class Type
{
    #[Groups([
        'read:Document',
    ])]
    private string $id;

    #[Groups([
        'export:Document',
        'read:Document',
    ])]
    public string $value;

    private ?string $description;

    public function getId(): string
    {
        return $this->id;
    }
}
