<?php

namespace App\Entity;

use App\Entity\Vocabulary\SU\Relationship;

class StratigraphicRelationship
{
    private int $id;

    public SU $sxSU;

    public Relationship $relationship;

    public SU $dxSU;

    public function getId(): int
    {
        return $this->id;
    }
}
