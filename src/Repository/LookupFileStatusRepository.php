<?php

namespace App\Repository;

use App\Entity\LookupFileStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LookupFileStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method LookupFileStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method LookupFileStatus[]    findAll()
 * @method LookupFileStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LookupFileStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LookupFileStatus::class);
    }

    // /**
    //  * @return LookupFileStatus[] Returns an array of LookupFileStatus objects
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
    public function findOneBySomeField($value): ?LookupFileStatus
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
