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
            //TODO regex for x and 1200x800 cases
            'size' => new Assert\NotBlank(),
            //TODO change output name and file type based on extension
            'name' => new Assert\NotBlank()
        ];
    }
}