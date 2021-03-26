<?php


namespace App\Service;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
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
        private EntityManagerInterface $entityManager,
        private ParameterBagInterface $parameterBag,
        private FileStorage $fileStorage,
        private FileDecoder $fileDecoder
    ) {}

    public function save(UploadedFile|string $file): File
    {
        $temporaryFile = $this->fileDecoder->init($file, 'test.jpg');
        $this->entityManager->getConnection()->beginTransaction();
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

    public function saveImage(File $fileEntity, UploadedFile $temporaryFile)
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

        $this->entityManager->persist($fileEntity);
        $this->entityManager->flush();
    }

    public function createFileEntity(UploadedFile $temporaryFile): File
    {
        $originalFilename = pathinfo($temporaryFile->getClientOriginalName(), PATHINFO_FILENAME);
        $file = new File();
        $file->setName(
            strtolower($this->slugger->slug($originalFilename) . '-' . uniqid())
        );
        $file->setExtension($temporaryFile->guessExtension());
        $file->setMimeType($temporaryFile->getMimeType());
        $file->setSize($temporaryFile->getSize());

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
    }
}