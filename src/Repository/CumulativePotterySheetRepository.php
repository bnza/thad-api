<?php

namespace App\Repository;

use App\Entity\CumulativePotterySheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CumulativePotterySheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CumulativePotterySheet::class);
    }
}
