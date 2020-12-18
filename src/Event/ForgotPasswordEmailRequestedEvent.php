<?php


namespace App\Event;


class ForgotPasswordEmailRequestedEvent
{
    public const NAME = 'forgotPasswordEmail.requested';

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