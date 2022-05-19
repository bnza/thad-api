<?php

namespace App\Entity\Geom;

use App\Entity\SU;

class GeomSU
{
    private int $id;

    private SU $stratigraphicUnit;

    private string $geom;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): GeomSU
    {
        $this->stratigraphicUnit = $stratigraphicUnit;
        return $this;
    }

    public function getGeom(): string
    {
        return $this->geom;
    }

    public function setGeom(string $geom): GeomSite
    {
        $this->geom = $geom;
        return $this;
    }
}
