<?php


namespace App\OAuth2Bundle\Entity;


use DateTimeImmutable;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class AccessToken implements AccessTokenEntityInterface
{
    use AccessTokenTrait;
    use EntityTrait;
    use TokenEntityTrait;

    public function setPrivateKey(CryptKey $privateKey)
    {
        // TODO: Implement setPrivateKey() method.
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
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