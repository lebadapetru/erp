<?php

namespace App\Controller\File;

use App\Dao\FileDao;
use App\Entity\File;
use App\Processor\FileProcessor;
use App\Request\UploadRequest;
use App\Service\UploadService;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use League\Flysystem\FilesystemException;
use Throwable;

class CreateFileAction
{
    const PARAM_KEY_RELATIVE_PATH = 'relativePath';
    const PARAM_KEY_NAME          = 'name';
    const PARAM_KEY_TYPE          = 'type';
    const PARAM_KEY_FILE          = 'file';

    public function __construct(
        private FileProcessor $fileProcessor,
        private FileDao $fileDao,
        private UploadService $uploadService,
        private EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @throws ConnectionException
     * @throws Throwable
     * @throws FilesystemException
     */
    public function __invoke(UploadRequest $request): File
    {
        $params = $request->all();

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $processedParams = $this->fileProcessor->processParamsForCreate($params);
            $fileEntity = $this->fileDao->createFile($processedParams);
            $this->uploadService->save($fileEntity, $params[self::PARAM_KEY_FILE]);

            $this->entityManager->getConnection()->commit();
        } catch (Exception | FilesystemException | Throwable $exception) {
            $this->entityManager->getConnection()->rollBack();

            throw $exception;
        }

        return $fileEntity;
    }
}