<?php


namespace App\EventSubscriber;


use App\Entity\EmailToken;
use App\Entity\User;
use App\Event\AccountCreatedEvent;
use App\Event\VerificationEmailRequestedEvent;
use App\Security\RegisterService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AccountCreatedSubscriber implements EventSubscriberInterface
{

    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;
    /**
     * @var RegisterService
     */
    private RegisterService $registerService;

    public function __construct(
        ParameterBagInterface $parameterBag,
        MailerInterface $mailer,
        RegisterService $registerService
    )
    {
        $this->parameterBag = $parameterBag;
        $this->mailer = $mailer;
        $this->registerService = $registerService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AccountCreatedEvent::NAME => 'onAccountCreated',
            VerificationEmailRequestedEvent::NAME => 'onEmailVerificationRequested',
        ];
    }

    public function onAccountCreated(AccountCreatedEvent $event)
    {
        $user = $event->getUser();

        if (!$user || !($user instanceof User)) {
            throw new NotFoundHttpException();
        }

        if ($user->isVerified()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $emailToken = $this->registerService->generateAccountVerificationToken($user);
        $this->sendGreetingsEmail($user);
        $this->sendVerificationEmail($user, $emailToken);
    }

    public function sendGreetingsEmail(User $user)
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Greetings!')
            ->text('Test Greetings!')
            /*TODO create twig templates*/
            ->html('Wassup');

        $this->mailer->send($email);
    }

    public function sendVerificationEmail(User $user, EmailToken $emailToken)
    {
        $url = $this->parameterBag->get('app.url') .
            'register/' . $user->getId() .
            '/verify/' . $emailToken->getToken();

        $email = (new Email())
        ->from('hello@example.com')
        ->to($user->getEmail())
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again! ')
        /*TODO create twig templates*/
        ->html('<a href="' . $url . '">See Twig integration for better HTML integration!</a>');

        $this->mailer->send($email);
    }

    public function onEmailVerificationRequested(VerificationEmailRequestedEvent $event)
    {
        $user = $event->getUser();

        if (!$user || !($user instanceof User)) {
            throw new NotFoundHttpException();
        }

        if ($user->isVerified()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $emailToken = $this->registerService->generateAccountVerificationToken($user);

        $this->sendVerificationEmail($user, $emailToken);
    }
}