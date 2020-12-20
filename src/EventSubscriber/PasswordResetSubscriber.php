<?php


namespace App\EventSubscriber;


use App\Event\PasswordResetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mime\Email;

class PasswordResetSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            PasswordResetEvent::class => 'onPasswordReset',
        ];
    }

    public function onPasswordReset(PasswordResetEvent $event)
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Your password has been reset!')
            ->text("New password is: $randomString");
        /*TODO create twig templates*/

        $this->mailer->send($email);
    }
}