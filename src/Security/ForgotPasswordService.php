<?php


namespace App\Security;


use App\Entity\ForgotPasswordToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class ForgotPasswordService
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /*TODO upgrade to php8 and use typehint union for UserInterface*/
    public function generateResetPasswordToken(User $user): ForgotPasswordToken
    {
        $token = new ForgotPasswordToken();
        $token->setToken(Uuid::uuid4()->toString());
        $token->setUser($user);

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }
}