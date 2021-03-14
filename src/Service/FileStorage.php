<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileStorage
{
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    public function __construct(
        ParameterBagInterface $parameterBag
    )
    {
        $this->parameterBag = $parameterBag;
    }

    public function upload(UploadedFile $uploadedFile, string $name): File
    {
        try {
            /*TODO move files to s3*/
            $file = $uploadedFile->move(
                $this->getUploadDirectory(),
                $name
            );

        } catch (FileException $exception) {
            throw $exception;
        }

        return $file;
    }

    public function getUploadDirectory(): string
    {
        return $this->parameterBag->get('app.upload_directory');
    }
}