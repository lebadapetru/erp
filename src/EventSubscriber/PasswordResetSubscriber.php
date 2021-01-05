<?php


namespace App\EventSubscriber;


use App\Event\PasswordResetEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PasswordResetSubscriber implements EventSubscriberInterface
{
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(
        MailerInterface $mailer
    )
    {
        $this->mailer = $mailer;
    }
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
            ->to($event->getUser()->getEmail())
            ->subject('Your password has been reset!')
            ->text("New password is: ". $event->getPassword());
        /*TODO create twig templates*/

        $this->mailer->send($email);
    }
}