<?php


namespace App\OAuth2Bundle\Repository;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{

    public function getClientEntity($clientIdentifier): ClientEntityInterface
    {
        // TODO: Implement getClientEntity() method.
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        // TODO: Implement validateClient() method.
    }
}