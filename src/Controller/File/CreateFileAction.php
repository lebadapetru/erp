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

    /**
     * @throws \Throwable
     * @throws \League\Flysystem\FilesystemException
     */
    public function __invoke(UploadRequest $request): File
    {
        return $this->uploadService->save($request->all());
    }
}