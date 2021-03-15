<?php


namespace App\Service;

use App\Entity\File;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\UnableToWriteFile;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File as HttpsFoundationFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileStorage
{
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;
    /**
     * @var FilesystemOperator
     */
    private FilesystemOperator $fileSystem;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        ParameterBagInterface $parameterBag,
        LoggerInterface $logger,
        FilesystemOperator $publicUploadsFilesystem
    )
    {
        $this->parameterBag = $parameterBag;
        $this->fileSystem = $publicUploadsFilesystem;
        $this->logger = $logger;
    }

    public function upload(UploadedFile $uploadedFile, File $fileEntity): HttpsFoundationFile
    {
        $fileLocation = $fileEntity->getId() . '/' . $fileEntity->getName() . '.' . $fileEntity->getExtension();

        try {
            /*TODO move files to s3*/
            $stream = fopen($uploadedFile->getRealPath(), 'r');
            $result = $this->fileSystem->writeStream(
                $fileLocation,
                $stream
            );
            if (is_resource($stream)) {
                fclose($stream);
            }

            if (!$result) {
                throw new UnableToWriteFile($fileLocation);
            }
        } catch (FilesystemException | UnableToWriteFile $exception) {
            $this->logger->alert(sprintf('Couldn\'t write the "%s" file!', $fileLocation));
            throw $exception;
        }

        return new HttpsFoundationFile($this->getUploadDirectory() . '/' . $fileLocation);
    }

    public function delete(File $fileEntity)
    {
        $fileLocation = $fileEntity->getId() . '/' . $fileEntity->getName() . '.' . $fileEntity->getExtension();
        try {
            if ($this->fileSystem->fileExists($fileLocation)) {
                $result = $this->fileSystem->delete($fileLocation);

                if (!$result) {
                    throw new FileNotFoundException($fileLocation);
                }
            }
        } catch (FilesystemException $e) {
            $this->logger->alert(sprintf('Couldn\'t delete the "%s" file!', $fileLocation));
        }
    }

    public function getUploadDirectory(): string
    {
        return $this->parameterBag->get('app.upload_directory');
    }
}