<?php


namespace App\Security;


use App\Entity\EmailToken;
use App\Entity\User;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
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
    private EntityManagerInterface $entityManager;
    private ParameterBagInterface $parameterBag;
    private MailerInterface $mailer;
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * UserHelper constructor.
     * @param LoginFormAuthenticator $loginFormAuthenticator
     * @param GuardAuthenticatorHandler $guardAuthenticatorHandler
     * @param Security $security
     * @param EntityManagerInterface $entityManager
     * @param ParameterBagInterface $parameterBag
     * @param MailerInterface $mailer
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        LoginFormAuthenticator $loginFormAuthenticator,
        GuardAuthenticatorHandler $guardAuthenticatorHandler,
        Security $security,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $parameterBag,
        MailerInterface $mailer,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->loginFormAuthenticator = $loginFormAuthenticator;
        $this->guardAuthenticatorHandler = $guardAuthenticatorHandler;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
        $this->mailer = $mailer;
        $this->passwordEncoder = $passwordEncoder;
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


    public function verifyEmailToken(Request $request): RedirectResponse
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            /** @var $user User */
            $user = $this->entityManager
                ->getRepository(User::class)
                ->find(
                    $request->attributes->get('id')
                );

            if (!$user) {
                throw new NotFoundHttpException();
            }
            if ($user->isVerified()) {
                throw new ConflictHttpException('The account was already verified');
            }

            $token = $this->entityManager
                ->getRepository(EmailToken::class)
                ->getActiveToken(
                    $request->attributes->get('token'),
                    $user->getId()
                );

            if (!$token) {
                throw new NotFoundHttpException(); //TODO maybe a token has expired exception?
            }

            $user->setVerifiedAt(Carbon::now());

            //remove all user's tokens after success
            $user->getEmailTokens()->clear();

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->authenticateUser($user, $request);

            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
            /*TODO logs*/
        }

        return new RedirectResponse('/');
    }

    public function getUser(): \Symfony\Component\Security\Core\User\UserInterface
    {
        return $this->security->getUser();
    }

}