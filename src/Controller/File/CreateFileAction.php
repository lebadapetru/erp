<?php


namespace App\Controller\File;


use App\Entity\File;
use App\Request\UploadRequest;
use App\Service\UploadService;

class CreateFileAction
{
    public function __construct(
        private UploadService $uploadService
    ) {}

    public function __invoke(UploadRequest $request): File
    {
        $uploadedFile = $request->all()['file'];

        return $this->uploadService->save($uploadedFile);
    }
}