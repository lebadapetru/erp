<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\File;
use App\Request\UploadRequest;
use App\Service\FileDecoder;
use App\Service\UploadService;

class FileDataPersister implements DataPersisterInterface
{
    public function __construct(
        private DataPersisterInterface $decoratedDataPersister,
        private FileDecoder $fileDecoder,
        private UploadService $uploadService,
        UploadRequest $request
    )
    {
        $request->all();
    }

    public function supports($data): bool
    {
        return $data instanceof File;
    }

    /**
     * @param File $data
     * @return File
     */
    public function persist($data): File
    {
        $fileEntity = $this->uploadService->save($data->getFile());

        //$this->decoratedDataPersister->persist($fileEntity);

        return $data;
    }

    public function remove($data)
    {
        $this->decoratedDataPersister->remove($data);
    }
}