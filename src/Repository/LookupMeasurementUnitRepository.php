<?php

namespace App\Repository;

use App\Entity\LookupMeasurementUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LookupMeasurementUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method LookupMeasurementUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method LookupMeasurementUnit[]    findAll()
 * @method LookupMeasurementUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LookupMeasurementUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LookupMeasurementUnit::class);
    }

    // /**
    //  * @return LookupMeasurementUnit[] Returns an array of LookupMeasurementUnit objects
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
    public function findOneBySomeField($value): ?LookupMeasurementUnit
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
