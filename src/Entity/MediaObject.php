<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\CreateMediaObjectAction;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get',
        'post' => [
            'controller' => CreateMediaObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'media_object:create'],
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    iri: 'http://schema.org/MediaObject',
    itemOperations: ['get'],
    normalizationContext: ['groups' => ['media_object:read']],
    security: 'is_granted("ROLE_EDITOR")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'sha256' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['sha256'],
    message: 'Duplicate media object (SHA256 hash): {{ value }}',
    errorPath: 'sha256',
)]
class MediaObject
{
    #[Groups([
        'read:MediaSU',
    ])]
    private ?int $id = null;

    #[ApiProperty(iri: 'http://schema.org/contentUrl')]
    #[Groups([
        'read:Document',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
        'media_object:read',
    ])]
    public ?string $contentUrl = null;

    #[Assert\NotNull(groups: ['media_object:create'])]
    public ?File $file = null;

    public string $filePath;

    public string $sha256;

    #[Groups([
        'read:Document',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public string $mimeType;

    public int $size;

    private ?int $width = null;

    private ?int $height = null;

    #[Groups([
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public ?Document $document;

    public iterable $stratigraphicUnits;
    public iterable $potteries;
    public iterable $smallFinds;
    public iterable $ecofacts;
    public iterable $samples;
    public iterable $graves;

    #[Groups(['media_object:read'])]
    public \DateTimeImmutable $uploadDate;

    public function __construct()
    {
        $this->stratigraphicUnits = new ArrayCollection();
        $this->potteries = new ArrayCollection();
        $this->smallFinds = new ArrayCollection();
        $this->ecofacts = new ArrayCollection();
        $this->samples = new ArrayCollection();
        $this->graves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups([
        'read:Document',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public function getDimensions(): ?array
    {
        return $this->width ? [$this->width, $this->height] : null;
    }

    public function setDimensions(?array $dimensions): MediaObject
    {
        $this->width = $dimensions[0];
        $this->height = $dimensions[1];

        return $this;
    }
}
