<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Site;
use App\Entity\SU;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

class SURepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SU::class);
    }

    public function numberExistsInSite(int $number, Area $area): bool
    {
        $qb = $this->createQueryBuilder('su');

        // @TODO use EXISTS query
        $qb->select('count(su.id)')
            ->leftJoin(
                Site::class,
                'a',
                Expr\Join::WITH,
                $qb->expr()->eq('a.id',
                    $area->getSite()->getId())
            )
            ->where($qb->expr()->eq('su.number', $number));

        return (bool) $qb->getQuery()->getSingleScalarResult();
    }
}
