<?php


namespace App\OAuth2Bundle\Repository;


use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{

    public function getNewToken(
        ClientEntityInterface $clientEntity,
        array $scopes,
        $userIdentifier = null
    ): AccessTokenEntityInterface
    {
        // TODO: Implement getNewToken() method.
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        // TODO: Implement persistNewAccessToken() method.
    }

    public function revokeAccessToken($tokenId)
    {
        // TODO: Implement revokeAccessToken() method.
    }

    public function isAccessTokenRevoked($tokenId)
    {
        // TODO: Implement isAccessTokenRevoked() method.
    }
}