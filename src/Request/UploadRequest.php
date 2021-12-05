<?php


namespace App\Request;

use App\Controller\File\CreateFileAction;
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
            CreateFileAction::PARAM_KEY_RELATIVE_PATH => [
                new Assert\NotBlank([
                    'allowNull' => true,
                ]),
            ],
            CreateFileAction::PARAM_KEY_NAME => [
                new Assert\NotBlank(),
            ],
            CreateFileAction::PARAM_KEY_TYPE => [
                new Assert\NotBlank(),
                new Assert\Choice([
                    'choices' => File::getAcceptedMimeTypes()
                ])
            ],
            CreateFileAction::PARAM_KEY_FILE => [
                new Assert\NotBlank(),
                new Assert\File([
                    'maxSize' => '5M',
                    'mimeTypes' => File::getAcceptedMimeTypes(),
                ]),
            ],
        ];
    }
}