<?php

namespace App\Repository;

use App\Entity\Pottery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PotteryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private SiteRepository $siteRepository)
    {
        parent::__construct($registry, Pottery::class);
    }

    public function findOneByCode(string $code): ?Area
    {
        $chunks = explode('.', $code);
        if (2 !== sizeof($chunks)) {
            return null;
        }

        return $this->findOneByCodes($chunks[0], $chunks[1]);
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
