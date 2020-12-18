<?php


namespace App\Security;


use App\Entity\EmailToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class RegisterService
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;
    private SecurityHelper $securityHelper;
    private EventDispatcherInterface $dispatcher;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        SecurityHelper $securityHelper,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->securityHelper = $securityHelper;
        $this->dispatcher = $dispatcher;
    }

    public function createAccount(array $request): User
    {
        if (
        $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $request['email']])
        ) {
            throw new ConflictHttpException('The email address is already in use');
        }

        $user = new User();
        $user->setFirstName($request['firstName']);
        $user->setLastName($request['lastName']);
        $user->setEmail($request['email']);
        $user->setUsername($request['email']);
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $request['password']
            )
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        /*TODO maybe a welcome email*/

        return $user;
    }

    /*TODO upgrade to php8 and use typehint union for UserInterface*/
    public function generateAccountVerificationToken(User $user): EmailToken
    {
        $token = new EmailToken();
        $token->setToken(Uuid::uuid4()->toString());
        $token->setUser($user);

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }
}