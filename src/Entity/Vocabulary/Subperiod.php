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
    normalizationContext: [
        'groups' => [
            'read:Voc:Subperiod',
        ],
    ],
    routePrefix: 'vocabulary',
)]
class Subperiod
{
    #[Groups([
        'read:Voc:Subperiod',
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    private int $id;

    #[Groups([
        'read:Voc:Subperiod',
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
    ])]
    public ?Period $period;

    #[Groups([
        'read:Voc:Subperiod',
        'read:Area',
        'read:Pottery',
        'read:SmallFind',
        'read:SU',
        'read:Grave',
    ])]
    public string $code;

    #[Groups([
        'read:Voc:Subperiod',
        'export:SmallFind',
        'export:Pottery',
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
