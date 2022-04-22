<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Vocabulary\SU\Relationship;

class StratigraphicRelationship
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

    public function setSxSU(SU $sxSU): StratigraphicRelationship
    {
        $this->sxSU = $sxSU;

        return $this;
    }

    public function getRelationship(): Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(Relationship $relationship): StratigraphicRelationship
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getDxSU(): SU
    {
        return $this->dxSU;
    }

    public function setDxSU(SU $dxSU): StratigraphicRelationship
    {
        $this->dxSU = $dxSU;

        return $this;
    }
}
