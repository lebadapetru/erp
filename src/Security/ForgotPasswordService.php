<?php


namespace App\Security;


use App\Entity\ResetPasswordToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ForgotPasswordService
{
    private EntityManagerInterface $entityManager;
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    public function __construct(
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        ParameterBagInterface $parameterBag
    )
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->parameterBag = $parameterBag;
    }

    /*TODO upgrade to php8 and use typehint union for UserInterface*/
    public function generateResetPasswordToken(User $user): ResetPasswordToken
    {
        $token = new ResetPasswordToken();
        $token->setToken(Uuid::uuid4()->toString());
        $token->setUser($user);

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }

    public function sendResetPasswordEmail(User $user)
    {
        $resetPassword = $this->generateResetPasswordToken($user);
        $url = $this->parameterBag->get('app.url') .
            'forgot-password/' . $user->getId() .
            '/verify/' . $resetPassword->getToken();

        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Forgot Password!')
            ->text('Sending emails is fun again! ')
            /*TODO create twig templates*/
            ->html('<a href="' . $url . '">See Twig integration for better HTML integration!</a>');

        $this->mailer->send($email);
    }
}