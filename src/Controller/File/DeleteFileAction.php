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
     * @throws \League\Flysystem\FilesystemException
     */
    public function __invoke(File $file): void
    {
        $this->uploadService->delete($file);
    }
}