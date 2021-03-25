<?php


namespace App\Controller\File;


use App\Entity\File;
use App\Request\UploadRequest;
use App\Service\UploadService;

class CreateFileAction
{
    public function __construct(
        public UploadRequest $request,
        public UploadService $uploadManager
    ) {}

    public function __invoke(File $data): Book
    {
        $this->bookPublishingHandler->handle($data);

        return $data;
    }
}