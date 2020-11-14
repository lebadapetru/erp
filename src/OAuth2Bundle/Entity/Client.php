<?php


namespace App\OAuth2Bundle\Entity;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class Client implements ClientEntityInterface
{
    use ClientTrait;
    use EntityTrait;

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getRedirectUri()
    {
        // TODO: Implement getRedirectUri() method.
    }

    public function isConfidential()
    {
        // TODO: Implement isConfidential() method.
    }
}