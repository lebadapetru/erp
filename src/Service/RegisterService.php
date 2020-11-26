<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService
{
    private ?Request $request;
    private ValidatorInterface $validator;
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;
    private MailerInterface $mailer;
    private ParameterBagInterface $parameterBag;
    private UserHelper $userHelper;
    private Security $security;

    public function __construct(
        RequestStack $requestStack,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        ParameterBagInterface $parameterBag,
        MailerInterface $mailer,
        UserHelper $userHelper,
        Security $security
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->parameterBag = $parameterBag;
        $this->mailer = $mailer;
        $this->userHelper = $userHelper;
        $this->security = $security;
    }

    public function validateRequest()
    {
        $constraints = new Assert\Collection([
            'firstName' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'max' => 128
                ]),
            ],
            'lastName' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'max' => 128
                ]),
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length([
                    'max' => 128
                ])
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => 8,
                    'max' => 128
                ]),
            ],
            'confirmPassword' => [
                new Assert\NotBlank(),
                new Assert\IdenticalTo([
                    'value' => $this->request->request->get('password'),
                    'message' => 'Passwords do not match.'
                ])
            ],
            'agreeTermsAndConditions' => new Assert\Choice([
                'choices' => [true, 1, 'true']
            ]),
        ]);

        $violations = $this->validator->validate($this->request->request->all(), $constraints);
        
        $errorMessages = [];
        foreach ($violations as $violation) {
            $errorMessages[] = $violation->getMessage();
            throw new BadRequestHttpException($violation->getMessage());
        }

        //TODO create event listener kernel.exception to display standardized validation error

        return $this;
    }

    public function createAccount(): User
    {
        if (
        $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $this->request->request->get('email')])
        ) {
            throw new ConflictHttpException('The email address is already in use');
        }

        $user = new User();
        $user->setFirstName($this->request->request->get('firstName'));
        $user->setLastName($this->request->request->get('lastName'));
        $user->setEmail($this->request->request->get('email'));
        $user->setUsername($this->request->request->get('email'));
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $this->request->request->get('password')
            )
        );

        $this->validator->validate($user); //validate the entity TODO check this

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->userHelper->authenticateUser($user, $this->request);

        return $user;
    }

    public function sendVerificationEmail()
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->find(
                $this->security->getUser()->getId()
            );

        if ($user->isActive()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $password = substr($user->getPassword(), 0, 7);
        $email = $user->getEmail();

        $token = password_hash($password . $email, CRYPT_BLOWFISH);

        $url = $this->parameterBag->get('app.url') . 'verify/' . $id . '/' . rawurlencode($token);
        $email = (new Email())
            ->from('hello@example.com')
            ->to('lebadap@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again! ')
            ->html('<a href="' . $url . '">See Twig integration for better HTML integration!</a>');

        $this->mailer->send($email);
    }

    public function verifyEmail()
    {
        $id = $this->request->attributes->get('id');
        $token = $this->request->attributes->get('token');

    }
}