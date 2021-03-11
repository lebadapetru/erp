<?php


namespace App\Service;


use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private string $uploadDirectory;
    private SluggerInterface $slugger;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(
        $uploadDirectory,
        SluggerInterface $slugger,
        EntityManagerInterface $entityManager
    )
    {
        $this->uploadDirectory = $uploadDirectory;
        $this->slugger = $slugger;
        $this->entityManager = $entityManager;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid();
        $fileExtension = $file->guessExtension();

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $uploadedFile = $file->move($this->getUploadDirectory(), $fileName.'.'.$fileExtension);
            /*TODO add files to s3*/
            dd($uploadedFile);
            $file = new File();
            $file->setName($fileName);
            $file->setExtension($fileExtension);
            $file->setMimeType($fileExtension);
            $file->setSize($uploadedFile->getSize());
            /*TODO add imagemagick to get width, height*/
            $file->setPath($uploadedFile->getPath());
            $file->setPath($uploadedFile->getPath());


            $this->entityManager->getConnection()->commit();
        } catch (FileException $exception) {
            $this->entityManager->getConnection()->rollBack();

            throw $exception;
            /*TODO logs*/
        }

        return $fileName;
    }

    public function getUploadDirectory(): string
    {
        return $this->uploadDirectory;
    }
}