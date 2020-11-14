<?php


namespace App\OAuth2Bundle\Entity;


use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;

class User implements UserEntityInterface
{
    use EntityTrait;

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }
}