<?php

namespace App\Entity\Vocabulary;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    routePrefix: 'vocabulary',
)]
class Period
{
    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    public string $code;

    #[Groups([
        'export:SU',
        'export:Pottery',
        'export:SmallFind',
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    public string $value;

    public iterable $subPeriods;

    #[Groups([
        'read:Area',
        'read:SU',
    ])]
    public ?string $description;

    public function __construct()
    {
        $this->subPeriods = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
