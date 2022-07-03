<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Vocabulary\Grave\Ritual;
use App\Entity\Vocabulary\Grave\Type;
use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\PreservationState;
use Doctrine\Common\Collections\ArrayCollection;
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
            'write:Grave',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Grave',
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
        'preservationState.value' => 'exact',
        'summary' => 'ipartial',
        'period.code' => 'exact',
        'preservation.code' => 'exact',
        'type.value' => 'exact',
    ]
)]
class Grave
{
    #[Groups([
        'read:MediaGrave',
        'read:Grave',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'read:MediaGrave',
        'write:Grave',
        'read:Grave',
        'read:SU',
    ])]
    #[Assert\NotNull]
    public int $number;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'SU excavation year must be between {{ min }} and {{ max }}',
        min: 2000,
        max: 2099,
    )]
    public int $year;

    #[Assert\NotNull]
    public iterable $stratigraphicUnits;

    #[Groups([
        'read:Grave',
    ])]
    private Site $site;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    private Area $area;

    #[Groups([
        'read:Grave',
        'write:Grave',
    ])]
    public ?Period $period;

    #[Groups([
        'read:Grave',
        'write:Grave',
    ])]
    public ?PreservationState $preservationState;

    #[Groups([
        'read:Grave',
        'write:Grave',
    ])]
    public ?Ritual $ritual;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public bool $isSecondaryDeposition = false;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    public Type $type;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $cutStratigraphicUnit;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $fillStratigraphicUnit;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $skeletonStratigraphicUnit;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $earlierThan;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?SU $laterThan;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $alignment;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $description;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $interpretation;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $summary;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $areaSupervisor;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?string $compiler;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    #[Assert\NotNull]
    public \DateTimeImmutable $date;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?int $building;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    private ?string $room;

    #[Groups([
        'write:Grave',
        'read:Grave',
    ])]
    public ?int $phase;

    public iterable $mediaObjects;

    public function __construct()
    {
        $this->stratigraphicUnits = new ArrayCollection();
        $this->mediaObjects = new ArrayCollection();
    }

    #[Groups([
        'export:SU',
        'read:SU',
    ])]
    public function getAppId(): ?string
    {
        if (!$this->site
            || !$this->year
            || !$this->number) {
            return null;
        }
        return sprintf("%s.%d.G.%'.05d", $this->site->getCode(), substr($this->year, 2), $this->number);
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

    public function setArea(Area $area): Grave
    {
        $this->area = $area;
        $this->site = $area->site;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): Grave
    {
        $this->room = $room ? strtolower($room) : $room;
        return $this;
    }
}
