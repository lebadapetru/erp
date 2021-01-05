<?php


namespace App\Event;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AccountCreatedEvent extends Event
{
    protected UserInterface $user;
    /*TODO type union with php8*/
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}