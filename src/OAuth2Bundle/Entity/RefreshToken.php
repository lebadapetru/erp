<?php


namespace App\OAuth2Bundle\Entity;


use DateTimeImmutable;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;

class RefreshToken implements RefreshTokenEntityInterface
{
    use RefreshTokenTrait;
    use EntityTrait;

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

    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        // TODO: Implement setAccessToken() method.
    }

    public function getAccessToken()
    {
        // TODO: Implement getAccessToken() method.
    }
}