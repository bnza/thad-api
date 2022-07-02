<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Vocabulary\Document\Type;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post',
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'patch',
        'delete',
    ],
    denormalizationContext: [
        'groups' => [
            'write:Document',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Document',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")',
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'site.id' => 'exact',
        'area.id' => 'exact',
        'area.code' => 'exact',
        'area.site.code' => 'exact',
        'areaSupervisor' => 'ipartial',
        'compiler' => 'ipartial',
        'description' => 'ipartial',
        'interpretation' => 'ipartial',
        'rooms' => 'partial',
        'buildings' => 'partial',
        'summary' => 'ipartial',
        'type.value' => 'exact',
    ]
)]
#[UniqueEntity(
    fields: ['mediaObject'],
    message: 'Duplicate media',
    errorPath: 'mediaObject',
)]
class Document
{
    #[Groups([
        'read:Document',
        'read:SU',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    private int $id;

    #[Groups([
        'write:Document',
        'read:Document',
        'read:SU',
    ])]
    #[Assert\NotNull]
    public int $number;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'SU excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    public int $year;

    #[Groups([
        'read:Document',
    ])]
    private Site $site;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    private Area $area;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public Type $type;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    private MediaObject $mediaObject;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $description;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $interpretation;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    public ?string $summary;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    public ?string $areaSupervisor;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public string $creator;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\NotNull]
    public \DateTimeImmutable $date;

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Positive(),
    ])]
    public array $buildings = [];

    #[Groups([
        'write:Document',
        'read:Document',
    ])]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Length(max: 3),
        new Assert\Regex('/^[a-z]*$/'),
    ])]
    public array $rooms = [];

    #[Groups([
        'export:Document',
        'read:Document',
        'read:MediaGrave',
        'read:MediaSample',
        'read:MediaEcofact',
        'read:MediaSmallFind',
        'read:MediaPottery',
        'read:MediaSU',
    ])]
    public function getAppId(): ?string
    {
        if (!$this->site
            || !$this->year
            || !$this->number) {
            return null;
        }

        return sprintf("%s.%d.D.%'.05d", $this->site->getCode(), substr($this->year, 2), $this->number);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): Document
    {
        $this->area = $area;
        $this->site = $area->getSite();

        return $this;
    }

    public function getMediaObject(): MediaObject
    {
        return $this->mediaObject;
    }

    public function setMediaObject(MediaObject $mediaObject): Document
    {
        $this->mediaObject = $mediaObject;

        return $this;
    }

    public function ensureId(LifecycleEventArgs $event)
    {
        if (!isset($this->id)) {
            $this->id = $this->mediaObject->getId();
        }
    }
}
