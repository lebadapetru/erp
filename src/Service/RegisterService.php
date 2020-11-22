<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterService
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    private function validate(Request $request)
    {
        $constraints = new Assert\Collection([
            'firstName' => new Assert\NotBlank(),
            'lastName' => new Assert\NotBlank(),
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 8]),
            ],
            'confirmPassword' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 8]),
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
        $this->validate($request);


    }
}