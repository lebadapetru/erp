<?php

namespace App\Repository;

use App\Entity\VariantValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VariantValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariantValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariantValue[]    findAll()
 * @method VariantValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariantValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariantValue::class);
    }

    // /**
    //  * @return VariantValue[] Returns an array of VariantValue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VariantValue
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
