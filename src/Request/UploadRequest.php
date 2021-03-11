<?php


namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UploadRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'file' => [
                new Assert\File(),
            ]
        ];
    }
}