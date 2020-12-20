<?php


namespace App\Request\Security;


use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class ForgotPasswordRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length([
                    'max' => 128
                ])
            ],
        ];
    }
}