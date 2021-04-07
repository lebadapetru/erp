<?php

namespace App\Repository;

use App\Entity\LookupProductStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LookupProductStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method LookupProductStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method LookupProductStatus[]    findAll()
 * @method LookupProductStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LookupProductStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LookupProductStatus::class);
    }

    // /**
    //  * @return LookupProductStatus[] Returns an array of LookupProductStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LookupProductStatus
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
