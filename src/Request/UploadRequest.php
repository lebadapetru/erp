<?php


namespace App\Request;

use App\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;

class UploadRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'file' => [
                new Assert\NotBlank(),
                new Assert\File([
                    'maxSize' => '5M',
                    'mimeTypes' => array_merge(...array_values(File::ACCEPTED_MIME_TYPES)),
                ]),
            ]
        ];
    }
}