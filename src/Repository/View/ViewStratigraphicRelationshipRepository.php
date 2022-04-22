<?php

namespace App\Repository\View;

use App\Entity\SU;
use App\Entity\View\ViewStratigraphicRelationship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ViewStratigraphicRelationshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViewStratigraphicRelationship::class);
    }

    private function straightRelationExists(SU $sxSu, SU $dxSU): bool
    {
        return (bool) $this->findOneBy(['sxSU' => $sxSu, 'dxSU' => $dxSU]);
    }

    public function inverseRelationExists(SU $sxSu, SU $dxSU): bool
    {
        return $this->straightRelationExists($dxSU, $sxSu);
    }

    public function relationExists(SU $sxSu, SU $dxSU): bool
    {
        return $this->straightRelationExists($sxSu, $dxSU) || $this->inverseRelationExists($sxSu, $dxSU);
    }
}
