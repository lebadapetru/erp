<?php


namespace App\Request;

use App\Entity\File;
use Symfony\Component\Validator\Constraints as Assert;

class UploadRequest extends BaseRequest
{
    protected function getData(): array
    {
        return array_merge(
            $this->request->request->all(),
            $this->request->files->all()
        );
    }

    protected function rules(): array
    {
        return [
            'relativePath' => [
                new Assert\NotBlank([
                    'allowNull' => true,
                ]),
            ],
            'name' => [
                new Assert\NotBlank(),
            ],
            'type' => [
                new Assert\NotBlank(),
                new Assert\Choice([
                    'choices' => File::getAcceptedMimeTypes()
                ])
            ],
            'file' => [
                new Assert\NotBlank(),
                new Assert\File([
                    'maxSize' => '5M',
                    'mimeTypes' => File::getAcceptedMimeTypes(),
                ]),
            ],
        ];
    }
}