<?php


namespace App\OAuth2Bundle\Controller;


use App\OAuth2Bundle\Repository\AccessTokenRepository;
use App\OAuth2Bundle\Repository\ClientRepository;
use App\OAuth2Bundle\Repository\ScopeRepository;
use Defuse\Crypto\Key;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends AbstractController
{
    /**
     * @Route("/token", methods={"GET"})
     * @param ClientRepository $clientRepository
     * @param AccessTokenRepository $accessTokenRepository
     * @param ScopeRepository $scopeRepository
     * @throws \Defuse\Crypto\Exception\BadFormatException
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     */
    public function index(
        ClientRepository $clientRepository,
        AccessTokenRepository $accessTokenRepository,
        ScopeRepository $scopeRepository
    )
    {
        $privateKey = new CryptKey(
            $this->getParameter('app.private_key_path'),
            null,
            $this->getParameter('app.key_permission_check')
        );
        $server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            Key::loadFromAsciiSafeString(
                $this->getParameter('app.encryption_key')
            )
        );
        dd($server);
    }
}