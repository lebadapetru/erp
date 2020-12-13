<?php


namespace App\Request\User;


use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as Rule;

class VerifyRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'id' => [
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Rule\UserExistsById()
            ],
            'token' => [
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Uuid(),
            ],
        ];
    }
}