<?php

namespace App\Entity\Vocabulary;

use ApiPlatform\Core\Annotation\ApiResource;
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
class Subperiod
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
    ])]
    public ?Period $period;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    public string $code;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
    ])]
    public string $value;

    #[Groups([
        'read:Area',
        'read:SU',
    ])]
    public ?string $description;

    public function getId(): int
    {
        return $this->id;
    }
}
