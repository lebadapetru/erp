<?php


namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ImageRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'id' => [
                new Assert\NotBlank(),
                new Assert\Uuid([
                    'versions' => [
                        Assert\Uuid::V4_RANDOM
                    ]
                ])
            ],
            'dimensions' => [
                new Assert\NotBlank(),
                new Assert\Regex([
                    'pattern' => '/^(\d+)?x(\d+)?$/i'
                ]),
            ],
            'name' => [
                new Assert\NotBlank(),
                new Assert\Regex([
                    'pattern' => '/^[\w,\s-]+\.[A-Za-z]{3,4}$/'
                ])
            ],
        ];
    }
}