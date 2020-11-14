<?php


namespace App\OAuth2Bundle\Entity;


use DateTimeImmutable;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class AuthCode implements AuthCodeEntityInterface
{
    use EntityTrait;
    use TokenEntityTrait;
    use AuthCodeTrait;

    public function getRedirectUri()
    {
        // TODO: Implement getRedirectUri() method.
    }

    public function setRedirectUri($uri)
    {
        // TODO: Implement setRedirectUri() method.
    }

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function setIdentifier($identifier)
    {
        // TODO: Implement setIdentifier() method.
    }

    public function getExpiryDateTime()
    {
        // TODO: Implement getExpiryDateTime() method.
    }

    public function setExpiryDateTime(DateTimeImmutable $dateTime)
    {
        // TODO: Implement setExpiryDateTime() method.
    }

    public function setUserIdentifier($identifier)
    {
        // TODO: Implement setUserIdentifier() method.
    }

    public function getUserIdentifier()
    {
        // TODO: Implement getUserIdentifier() method.
    }

    public function getClient()
    {
        // TODO: Implement getClient() method.
    }

    public function setClient(ClientEntityInterface $client)
    {
        // TODO: Implement setClient() method.
    }

    public function addScope(ScopeEntityInterface $scope)
    {
        // TODO: Implement addScope() method.
    }

    public function getScopes()
    {
        // TODO: Implement getScopes() method.
    }
}