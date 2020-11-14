<?php


namespace App\OAuth2Bundle\Repository;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{

    public function getScopeEntityByIdentifier($identifier): ScopeEntityInterface
    {
        // TODO: Implement getScopeEntityByIdentifier() method.
    }

    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null)
    {
        // TODO: Implement finalizeScopes() method.
    }
}