<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;
    private UserHelper $userHelper;
    private EmailTokenService $emailTokenService;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        UserHelper $userHelper,
        EmailTokenService $emailTokenService
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userHelper = $userHelper;
        $this->emailTokenService = $emailTokenService;
    }

    public function register(Request $request)
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->createAccount($request);

            $this->userHelper->sendVerificationEmail();

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

        $this->userHelper->authenticateUser($user, $request);

        /*TODO maybe a welcome email*/

        return $user;
    }
}