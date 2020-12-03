<?php


namespace App\Service;


use App\Entity\User;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService
{
    private ValidatorInterface $validator;
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;
    private MailerInterface $mailer;
    private ParameterBagInterface $parameterBag;
    private UserHelper $userHelper;
    private Security $security;
    private EmailTokenService $emailTokenService;

    public function __construct(
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        ParameterBagInterface $parameterBag,
        MailerInterface $mailer,
        UserHelper $userHelper,
        Security $security,
        EmailTokenService $emailTokenService
    )
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->parameterBag = $parameterBag;
        $this->mailer = $mailer;
        $this->userHelper = $userHelper;
        $this->security = $security;
        $this->emailTokenService = $emailTokenService;
    }

    public function register(Request $request)
    {
        $this->entityManager->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            $this->validateRequest($request);
            $this->createAccount($request);

            $this->sendVerificationEmail();

            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
            /*TODO logs*/
        }
    }

    public function validateRequest(Request $request)
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
                    'value' => $request->request->get('password'),
                    'message' => 'Passwords do not match.'
                ])
            ],
            'agreeTermsAndConditions' => new Assert\Choice([
                'choices' => [true, 1, 'true']
            ]),
        ]);

        $violations = $this->validator->validate($request->request->all(), $constraints);

        $errorMessages = [];
        foreach ($violations as $violation) {
            $errorMessages[] = $violation->getMessage();
            throw new BadRequestHttpException($violation->getMessage());
        }

        //TODO create event listener kernel.exception to display standardized validation error
    }

    public function createAccount(Request $request): User
    {
        if (
        $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $request->get('email')])
        ) {
            throw new ConflictHttpException('The email address is already in use');
        }

        $user = new User();
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setEmail($request->request->get('email'));
        $user->setUsername($request->request->get('email'));
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $request->request->get('password')
            )
        );

        $this->validator->validate($user); //validate the entity TODO check this

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->userHelper->authenticateUser($user, $request);

        /*TODO maybe a welcome email*/

        return $user;
    }

    public function sendVerificationEmail(): void
    {
        $user = $this->security->getUser();
        if (!$user || !($user instanceof User)) {
            throw new NotFoundHttpException();
        }

        if ($user->isActive()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $tokenEntity = $this->emailTokenService->generateToken($user);
        $url = $this->parameterBag->get('app.url') . 'register/' . $user->getId() . '/verify/' . $tokenEntity->getToken();
        /*TODO create mail templates*/
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again! ')
            ->html('<a href="' . $url . '">See Twig integration for better HTML integration!</a>');

        $this->mailer->send($email);
    }

    public function verifyEmail(Request $request)
    {
        $userId = $request->attributes->get('id');
        $token = $request->attributes->get('token');

        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($userId);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        if ($user->isActive()) {
            throw new ConflictHttpException('The account was already verified');
        }

        if (!$this->emailTokenService->isTokenValid($token, $user)) {
            throw new NotFoundHttpException();
        }

        $user->setIsActive(true);
        $user->setVerifiedAt(Carbon::now());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->userHelper->authenticateUser($user, $request);
    }
}