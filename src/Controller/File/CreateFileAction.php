<?php


namespace App\Controller\File;


use App\Entity\File;
use App\Request\UploadRequest;
use App\Service\UploadService;
use League\Flysystem\FilesystemException;

class CreateFileAction
{
    public function __construct(
        private UploadService $uploadService
    ) {}

    /**
     * @throws \Throwable
     * @throws FilesystemException
     */
    public function __invoke(UploadRequest $request): File
    {
        //todo create processor
        return $this->uploadService->save($request->all());
    }
}