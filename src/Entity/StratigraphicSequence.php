<?php

namespace App\Entity;

use App\Entity\Vocabulary\SU\Sequence;

class StratigraphicSequence
{
    private int $id;

    public SU $sxSU;

    public Sequence $relationship;

    public SU $dxSU;

    public function getId(): int
    {
        return $this->id;
    }
}
