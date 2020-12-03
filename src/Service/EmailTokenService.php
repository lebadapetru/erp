<?php


namespace App\Service;


use App\Entity\EmailToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class EmailTokenService
{
    private EntityManagerInterface $entityManager;
    private int $expire = 60;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /*TODO upgrade to php8 and use typehint union for UserInterface*/
    public function generateToken(User $user): EmailToken
    {
        $token = new EmailToken();
        $token->setToken(Uuid::uuid4()->toString());
        $token->setUser($user);

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }

    public function isTokenValid(string $token, User $user): bool
    {
        $tokenEntity = $user->getEmailTokens()->first();

        dd($tokenEntity);
        return false;
    }
}