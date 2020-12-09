<?php

namespace App\Repository;

use App\Entity\EmailToken;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
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

    public function getActiveToken(string $token, int $userId, int $expires = 600): string
    {
//        $conn = $this->getEntityManager()
//            ->getConnection();
//
//        $sql = '
//            SELECT token
//            FROM email_tokens
//            WHERE token = :token
//            AND user_id = :userId
//            AND created_at < (created_at + INTERVAL \'' . round($expires / 60) . ' minutes\')
//            ';
//
//        $stmt = $conn->prepare($sql);
//        $stmt->execute([
//            'token' => $token,
//            'userId' => $userId,
//        ]);

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\EmailToken', 'u');

        $rsm->addScalarResult('token', 'token');

        $query = $this->getEntityManager()
            ->createNativeQuery("
            SELECT *
            FROM email_tokens 
            WHERE token = :token 
            AND user_id = :userId
            AND created_at < (created_at + (:expires * INTERVAL '1 minutes'))
            ", $rsm);

        $query->setParameters([
            'expires' => (int)round($expires / 60),
            'token' => $token,
            'userId' => $userId,
        ]);

        $users = $query->getOneOrNullResult();
        dd($users);
        return $stmt->fetchOne();
    }
}
