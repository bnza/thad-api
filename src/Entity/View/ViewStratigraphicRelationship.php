<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\SU;
use App\Entity\Vocabulary\SU\Relationship;
use App\Validator as AppValidator;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
            ],
        'post',
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'delete',
    ],
    shortName: 'StratigraphicRelationship',
    security: 'is_granted("ROLE_EDITOR")'
)]
#[UniqueEntity(
    fields: ['sxSU', 'dxSU'],
    message: 'Stratigraphic relationship between given SUs already exists',
    errorPath: 'sxSU',
)]
#[AppValidator\InverseSURelationAbsent()]
class ViewStratigraphicRelationship
{
    private int $id;

    private SU $sxSU;

    private Relationship $relationship;

    private SU $dxSU;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSxSU(): SU
    {
        return $this->sxSU;
    }

    public function setSxSU(SU $sxSU): ViewStratigraphicRelationship
    {
        $this->sxSU = $sxSU;

        return $this;
    }

    public function getRelationship(): Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(Relationship $relationship): ViewStratigraphicRelationship
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getDxSU(): SU
    {
        return $this->dxSU;
    }

    public function setDxSU(SU $dxSU): ViewStratigraphicRelationship
    {
        $this->dxSU = $dxSU;

        return $this;
    }
}
