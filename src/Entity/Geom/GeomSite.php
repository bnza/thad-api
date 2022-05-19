<?php

namespace App\Entity\Geom;

use App\Entity\Site;

class GeomSite
{
    private int $id;

    private Site $site;

    private string $geom;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    public function setSite(Site $site): GeomSite
    {
        $this->site = $site;
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
