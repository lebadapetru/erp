<?php


namespace App\Service;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToDeleteFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\UuidV4;

class UploadService
{
    public function __construct(
        private SluggerInterface $slugger,
        private EntityManagerInterface $entityManager,
        private FileStorage $fileStorage,
    ) {}

    public function save(array $data): File
    {
        /**@var UploadedFile $temporaryFile*/
        $temporaryFile = $data['file'];
        /**@var UuidV4 $uuid*/
        $uuid = $data['id'] ? UuidV4::fromString($data['id']) : UuidV4::v4();
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $fileEntity = $this->createFileEntity($temporaryFile, $uuid);

            /*TODO add support for videos, media urls, audios, vts*/
            if ($fileEntity->isImage()) {
                $this->saveImage($fileEntity, $temporaryFile);
            } elseif ($fileEntity->isVideo()) {
                //} elseif (Helpers::isMediaUrl($uploadedFileMimeType)) {
            } else {
                throw new BadRequestHttpException('Invalid file.');
            }
            $this->entityManager->getConnection()->commit();

        } catch (\Throwable $exception) {
            if (isset($fileEntity)) {
                try {
                    $this->fileStorage->delete($fileEntity);
                } catch (FilesystemException | UnableToDeleteFile $exception) {
                    //this is a behind the scene action, if it fails log it and let it pass
                }
            }
            $this->entityManager->getConnection()->rollBack();
            throw $exception;
        }

        return $fileEntity;
    }

    private function saveImage(File $fileEntity, UploadedFile $temporaryFile)
    {
        $this->fileStorage->upload(
            $temporaryFile,
            $fileEntity
        );
        $image = new \Imagick(
            $this->fileStorage->getRealFileLocation($fileEntity)
        );
        $fileEntity->setWidth($image->getImageWidth());
        $fileEntity->setHeight($image->getImageHeight());
        $fileEntity->setPath(
            $this->fileStorage->getFileLocation($fileEntity, false, false)
        );
        $fileEntity->setIsProcessed(true);

        $this->entityManager->persist($fileEntity);
        $this->entityManager->flush();
    }

    private function createFileEntity(UploadedFile $temporaryFile, ?UuidV4 $uuid = null): File
    {
        $originalFileName = pathinfo($temporaryFile->getClientOriginalName(), PATHINFO_FILENAME);
        //this one does strtolower, sanitization
        $fileName = $this->slugger->slug($originalFileName) . '-' . uniqid();
        $file = new File($uuid);
        $file->setOriginalName($fileName);
        $file->setDisplayName($fileName);
        $file->setExtension($temporaryFile->guessExtension());
        $file->setMimeType($temporaryFile->getMimeType());
        $file->setSize($temporaryFile->getSize());

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
    }
}