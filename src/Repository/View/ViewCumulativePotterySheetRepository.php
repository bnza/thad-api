<?php

namespace App\Repository\View;

use App\Entity\View\ViewCumulativePotterySheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ViewCumulativePotterySheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViewCumulativePotterySheet::class);
    }
}
