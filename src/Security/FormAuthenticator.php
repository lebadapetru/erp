<?php


namespace App\Security;


use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class FormAuthenticator implements AuthenticatorInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): PassportInterface
    {
        // find a user based on an "email" form field
        $user = $this->userRepository->findOneByEmail($request->get('email'));
        if (!$user) {
            throw new UsernameNotFoundException();
        }

        // return the Security passport
        return new Passport(
        // add the user we've just found
            $user,
            // add credentials from the "password" form field
            new PasswordCredentials($request->get('password')),
            [
                // and CSRF protection using a "csrf_token" field
                new CsrfTokenBadge('loginform', $request->get('csrf_token')),
                // and add support for upgrading the password hash
                new PasswordUpgradeBadge(
                    $request->get('password'),
                    $this->userRepository
                )
            ],
        );
    }

    /**
     * @inheritDoc
     */
    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): TokenInterface
    {
        // TODO: Implement createAuthenticatedToken() method.
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }
}