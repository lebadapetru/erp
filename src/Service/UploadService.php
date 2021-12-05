<?php


namespace App\Service;

use App\Dao\FileDao;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use ImagickException;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToDeleteFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Throwable;

class UploadService
{
    public function __construct(
        private SluggerInterface       $slugger,
        private EntityManagerInterface $entityManager,
        private FileStorage            $fileStorage,
        private ParameterBagInterface  $parameterBag,
        private ImageService           $imageService,
    )
    {
    }

    public function save(File $fileEntity, UploadedFile $uploadedFile): File
    {
        try {
            /*TODO add support for videos, media urls, audios, vts*/
            if ($fileEntity->isImage()) {
                $this->saveImage($fileEntity, $uploadedFile);
            } elseif ($fileEntity->isVideo()) {
                //} elseif (Helpers::isMediaUrl($uploadedFileMimeType)) {
            } else {
                throw new BadRequestHttpException('Invalid file.');
            }
        } catch (Throwable $exception) {
            if (isset($fileEntity)) {
                try {
                    $this->fileStorage->delete($fileEntity);
                } catch (FilesystemException | UnableToDeleteFile $exception) {
                    //this is a behind the scene action, if it fails log it and let it pass
                }
            }

            throw $exception; //TODO custom exception
        }

        return $fileEntity;
    }

    /**
     * @throws ImagickException
     * @throws FilesystemException
     */
    private function saveImage(File $fileEntity, UploadedFile $uploadedFile)
    {
        //TODO this should be in a queue
        $this->fileStorage->write(
            $fileEntity,
            $uploadedFile
        );
        //maybe we wanna do some processing on the original file
        $image = new \Imagick(
            $this->fileStorage->getRealFileLocation($fileEntity)
        );
        $fileEntity->setWidth($image->getImageWidth());
        $fileEntity->setHeight($image->getImageHeight());
        $fileEntity->setPath(
            $this->fileStorage->getFileLocation($fileEntity, false, false)
        );

        $fileEntity->setStatus(File::STATUS_PROCESSED);

        $this->entityManager->persist($fileEntity);
        $this->entityManager->flush();
    }

    public function delete(File $fileEntity): void
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            //TODO remove liipimagine cache for a specific image
            $this->entityManager->remove($fileEntity);
            $this->fileStorage->deleteDirectory($fileEntity);
            $this->entityManager->flush();

            $this->entityManager->getConnection()->commit();
        } catch (Throwable $exception) {
            $this->entityManager->getConnection()->rollBack();
            throw $exception;
        }
    }
}