<?php


namespace App\Service;

use App\Entity\File;
use App\Entity\LookupFileStatus;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToDeleteFile;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
        private ParameterBagInterface $parameterBag,
        private ImageService $imageService,
        private CacheManager $cacheManager,
    )
    {
    }

    public function save(array $data): File
    {
        /**@var UploadedFile $temporaryFile */
        $temporaryFile = $data['files'];
        /**@var UuidV4 $id */
        $id = $data['id'] ? UuidV4::fromString($data['id']) : UuidV4::v4();
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $fileEntity = $this->createFileEntity($temporaryFile, $id);

            /*TODO add support for videos, media urls, audios, vts*/
            if ($fileEntity->isImage()) {
                $this->saveImage($fileEntity);
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

    private function saveImage(File $fileEntity)
    {
        $this->fileStorage->write(
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

        //set to processed
        $fileEntity->setStatus(
            $this->entityManager
                ->getRepository(LookupFileStatus::class)
                ->findOneBy([
                    'label' => LookupFileStatus::STATUSES[2]
                ])
        );

        $this->entityManager->persist($fileEntity);
        $this->entityManager->flush();
    }

    private function createFileEntity(UploadedFile $temporaryFile, ?UuidV4 $id = null): File
    {
        $originalFileName = pathinfo($temporaryFile->getClientOriginalName(), PATHINFO_FILENAME);
        //this one does strtolower, sanitization
        $fileName = $this->slugger->slug($originalFileName) . '-' . uniqid();
        $file = new File($id);
        $file->setRealName($fileName);
        $file->setDisplayName($fileName);
        $file->setExtension($temporaryFile->guessExtension());
        $file->setMimeType($temporaryFile->getMimeType());
        $file->setSize($temporaryFile->getSize());
        $file->setUploadedFile($temporaryFile);

        $url = $this->imageService->getUrl($file);
        $file->setUrl(
            $this->parameterBag->get('app.url') . $url
        );

        //set to processing
        $file->setStatus(
            $this->entityManager
                ->getRepository(LookupFileStatus::class)
                ->findOneBy([
                    'label' => LookupFileStatus::STATUSES[1]
                ])
        );

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
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
        } catch (\Throwable $exception) {
            $this->entityManager->getConnection()->rollBack();
            throw $exception;
        }
    }
}