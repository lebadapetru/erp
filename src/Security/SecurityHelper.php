<?php


namespace App\Security;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
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
     * UserHelper constructor.
     * @param LoginFormAuthenticator $loginFormAuthenticator
     * @param GuardAuthenticatorHandler $guardAuthenticatorHandler
     * @param Security $security
     */
    public function __construct(
        LoginFormAuthenticator $loginFormAuthenticator,
        GuardAuthenticatorHandler $guardAuthenticatorHandler,
        Security $security
    )
    {
        $this->loginFormAuthenticator = $loginFormAuthenticator;
        $this->guardAuthenticatorHandler = $guardAuthenticatorHandler;
        $this->security = $security;
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

}