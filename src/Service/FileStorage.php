<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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

    public function upload(UploadedFile $file, string $name): string
    {
        try {
            /*TODO move files to s3*/
            $uploadedFile = $file->move(
                $this->getUploadDirectory(),
                $name
            );

        } catch (FileException $exception) {

            throw $exception;
            /*TODO logs*/
        }

        return $uploadedFile;
    }

    public function getUploadDirectory(): string
    {
        return $this->parameterBag->get('app.upload_directory');
    }
}