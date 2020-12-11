<?php


namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        dd('yolo1');
        if (!$user instanceof User) {
            return;
        }

        if (!$user->isActive()) {
            // the message passed to this exception is meant to be displayed to the user
            throw new NotFoundHttpException('Your user account no longer exists.');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        dd('yolo');
        if (!$user instanceof User) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->isActive()) {
            throw new NotFoundHttpException('User could not be found.');
        }
    }
}
