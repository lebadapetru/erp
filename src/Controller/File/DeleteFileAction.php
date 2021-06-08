<?php


namespace App\Controller\File;


use App\Entity\File;
use App\Service\UploadService;

class DeleteFileAction
{
    public function __construct(
        private UploadService $uploadService
    ) {}

    /**
     * @throws \Throwable
     */
    public function __invoke(File $file): void
    {
        //TODO create validation request
        $this->uploadService->delete($file);
    }
}