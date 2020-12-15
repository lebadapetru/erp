<?php


namespace App\Security;


use App\Entity\EmailToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;
    private SecurityHelper $securityHelper;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        SecurityHelper $securityHelper,
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->securityHelper = $securityHelper;
    }

    public function register(Request $request)
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->createAccount($request);

            $this->sendAccountVerificationEmail();

            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
            /*TODO logs*/
        }
    }

    public function createAccount(Request $request): User
    {
        if (
        $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $request->get('email')])
        ) {
            throw new ConflictHttpException('The email address is already in use');
        }

        $user = new User();
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setEmail($request->request->get('email'));
        $user->setUsername($request->request->get('email'));
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $request->request->get('password')
            )
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->securityHelper->authenticateUser($user, $request);

        /*TODO maybe a welcome email*/

        return $user;
    }

    public function sendAccountVerificationEmail(): void
    {
        $user = $this->securityHelper->getUser();
        if (!$user || !($user instanceof User)) {
            throw new NotFoundHttpException();
        }

        if ($user->isVerified()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $tokenEntity = $this->generateAccountVerificationToken($user);

        /*TODO subscribe to user email event, sent token*/
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