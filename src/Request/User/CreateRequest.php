<?php


namespace App\Request\User;


use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
        ];
    }
}