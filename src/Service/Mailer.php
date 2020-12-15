<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
    private ParameterBagInterface $parameterBag;

    public function __construct(
        ParameterBagInterface $parameterBag
    )
    {
        $this->parameterBag = $parameterBag;
    }

    public function ceva()
    {
        $url = $this->parameterBag->get('app.url') . 'register/' . $user->getId() . '/verify/' . $tokenEntity->getToken();
        /*TODO create mail templates & dispatch an event*/
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again! ')
            ->html('<a href="' . $url . '">See Twig integration for better HTML integration!</a>');

        $this->mailer->send($email);
    }
}