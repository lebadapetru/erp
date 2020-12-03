<?php

namespace App\Repository;

use App\Entity\EmailToken;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmailToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailToken[]    findAll()
 * @method EmailToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailToken::class);
    }

    // /**
    //  * @return EmailToken[] Returns an array of EmailToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmailToken
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getActiveToken(string $token, int $userId, int $expires = 600): ?EmailToken
    {
        $emailTokenEntity =  $this->createQueryBuilder('e')
            ->andWhere('e.token = :token')
            ->setParameters([
                'token' => $token,
            ])
            ->getQuery()
            ->getResult();

        dd($emailTokenEntity->filter());
    }
}
