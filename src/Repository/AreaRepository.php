<?php

namespace App\Repository;

use App\Entity\Area;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AreaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private SiteRepository $siteRepository)
    {
        parent::__construct($registry, Area::class);
    }

    public function findOneByCodes(string $siteCode, string $areaCode): ?Area
    {
        $site = $this->siteRepository->findOneByCode($siteCode);
        if (!$site) {
            return null;
        }
        return parent::findOneBy(['site' => $site->getId(), 'code' => $areaCode]);
    }
}
