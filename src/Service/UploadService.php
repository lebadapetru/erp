<?php


namespace App\Service;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    private SluggerInterface $slugger;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    /**
     * @var FileStorage
     */
    private FileStorage $fileStorage;

    public function __construct(
        SluggerInterface $slugger,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $parameterBag,
        FileStorage $fileStorage
    )
    {
        $this->slugger = $slugger;
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
        $this->fileStorage = $fileStorage;
    }

    public function save(UploadedFile $temporaryFile): File
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $file = $this->createFileEntity($temporaryFile);

            if ($file->isImage()) {
                $this->saveImage($file, $temporaryFile);
            } elseif ($file->isVideo()) {

                //} elseif (Helpers::isMediaUrl($uploadedFileMimeType)) {

            } else {
                throw new BadRequestHttpException('Invalid file.');
            }
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $exception) {
            $this->entityManager->getConnection()->rollBack();
            /*TODO remove file if failed*/
            /*TODO add logger*/
            throw $exception;
        }

        return $file;
    }

    public function saveImage(File $fileEntity, UploadedFile $temporaryFile)
    {
        /* @var UploadedFile $file */
        $file = $this->fileStorage->upload(
            $temporaryFile,
            $fileEntity->getName() . '.' . $fileEntity->getExtension()
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