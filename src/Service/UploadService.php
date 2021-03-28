<?php


namespace App\Service;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\File;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToDeleteFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    public function __construct(
        private SluggerInterface $slugger,
        private DataPersisterInterface $decoratedDataPersister,
        private ParameterBagInterface $parameterBag,
        private FileStorage $fileStorage,
        private FileDecoder $fileDecoder
    ) {}

    public function save(UploadedFile $temporaryFile): File
    {
        $this->decoratedDataPersister->getConnection()->beginTransaction();
        try {

            $fileEntity = $this->createFileEntity($temporaryFile);

            /*TODO add support for videos, media urls, audios, vts*/
            if ($fileEntity->isImage()) {
                $this->saveImage($fileEntity, $temporaryFile);
            } elseif ($fileEntity->isVideo()) {
                //} elseif (Helpers::isMediaUrl($uploadedFileMimeType)) {
            } else {
                throw new BadRequestHttpException('Invalid file.');
            }
            $this->decoratedDataPersister->getConnection()->commit();

        } catch (\Throwable $exception) {
            if (isset($fileEntity)) {
                try {
                    $this->fileStorage->delete($fileEntity);
                } catch (FilesystemException | UnableToDeleteFile $exception) {
                    //this is a behind the scene action, if it fails log it and let it pass
                }
            }
            $this->decoratedDataPersister->getConnection()->rollBack();
            throw $exception;
        }

        return $fileEntity;
    }

    private function saveImage(File $fileEntity, UploadedFile $temporaryFile)
    {
        $file = $this->fileStorage->upload(
            $temporaryFile,
            $fileEntity
        );

        $image = new \Imagick($file->getRealPath());
        $fileEntity->setWidth($image->getImageWidth());
        $fileEntity->setHeight($image->getImageHeight());
        $fileEntity->setPath($file->getPath());
        $fileEntity->setIsProcessed(true);

        $this->decoratedDataPersister->persist($fileEntity);
        $this->decoratedDataPersister->flush();
    }

    private function createFileEntity(UploadedFile $temporaryFile): File
    {
        $originalFileName = pathinfo($temporaryFile->getClientOriginalName(), PATHINFO_FILENAME);
        //this one does strtolower, sanitization
        $fileName = $this->slugger->slug($originalFileName);
        $file = new File();
        $file->setOriginalName($fileName);
        $file->setDisplayName($fileName);
        $file->setExtension($temporaryFile->guessExtension());
        $file->setMimeType($temporaryFile->getMimeType());
        $file->setSize($temporaryFile->getSize());

        $this->decoratedDataPersister->persist($file);
        $this->decoratedDataPersister->flush();

        return $file;
    }
}