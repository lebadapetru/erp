<?php


namespace App\Event;


use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class PasswordResetEvent extends Event
{
    private string $password;
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user, string $password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}