<?php


namespace App\Security;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * Class UserHelper
 * @package App\Service
 */
class SecurityHelper
{
    /**
     * @var LoginFormAuthenticator
     */
    private LoginFormAuthenticator $loginFormAuthenticator;
    /**
     * @var GuardAuthenticatorHandler
     */
    private GuardAuthenticatorHandler $guardAuthenticatorHandler;
    private Security $security;
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;


    /**
     * UserHelper constructor.
     * @param LoginFormAuthenticator $loginFormAuthenticator
     * @param GuardAuthenticatorHandler $guardAuthenticatorHandler
     * @param Security $security
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        LoginFormAuthenticator $loginFormAuthenticator,
        GuardAuthenticatorHandler $guardAuthenticatorHandler,
        Security $security,
        UserPasswordEncoderInterface $passwordEncoder,
        MailerInterface $mailer,
        EntityManagerInterface $entityManager
    )
    {
        $this->loginFormAuthenticator = $loginFormAuthenticator;
        $this->guardAuthenticatorHandler = $guardAuthenticatorHandler;
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user the User object you just created
     * @param Request $request
     * @param string $providerKey the name of your firewall in security.yaml
     */
    public function authenticateUser(User $user, Request $request, string $providerKey = 'main'): void
    {
        if ($this->security->getUser()) {
            return;
        }

        $this->guardAuthenticatorHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $this->loginFormAuthenticator, // authenticator whose onAuthenticationSuccess you want to use
            $providerKey
        );
    }

    public function getUser(): UserInterface
    {
        return $this->security->getUser();
    }

    public function resetPassword(User $user): string
    {
        $randomString = null;
        $randomString = bin2hex(random_bytes(10));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $randomString
        ));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $randomString;
    }
}