<?php


namespace App\Service;


use App\Entity\EmailToken;
use App\Entity\User;
use App\Repository\EmailTokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class EmailTokenService
{
    private EntityManagerInterface $entityManager;
    private EmailTokenRepository $emailTokenRepository;
    private int $expire = 600;

    public function __construct(
        EntityManagerInterface $entityManager,
        EmailTokenRepository $emailTokenRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->emailTokenRepository = $emailTokenRepository;
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
}