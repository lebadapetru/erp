<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService
{
    private ValidatorInterface $validator;

    private EntityManagerInterface $entityManager;

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function validate(Request $request)
    {
        $constraints = new Assert\Collection([
            'firstName' => [ /*TODO create custom validator to check if value contains only spaces/tabs/etc*/
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
                    'value' => $request->request->get('confirmPassword'),
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

    public function save(Request $request)
    {
        if (
        $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $request->request->get('email')])
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

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function sendVerificationEmail(string $email)
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $email]);

        if ($user->isActive()) {
            throw new ConflictHttpException('The account was already verified');
        }

        $password = substr($user->getPassword(), 0, 7);
        $email = $user->getEmail();
        $id = $user->getId();

        $token = password_hash($password . $email . $id, CRYPT_BLOWFISH);
        //TODO add swiftmailer or some SMTP lib
        dd($token);
    }
}