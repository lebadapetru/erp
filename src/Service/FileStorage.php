<?php


namespace App\Service;

use App\Entity\File;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\UnableToDeleteFile;
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
        FilesystemOperator $defaultStorage
    )
    {
        $this->parameterBag = $parameterBag;
        $this->fileSystem = $defaultStorage;
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
            if ($result === false) {
                throw new UnableToWriteFile(sprintf('Couldn\'t write the "%s" file!', $fileLocation));
            }
        } catch (FilesystemException | UnableToWriteFile $exception) {
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

                if ($result === false) {
                    throw new UnableToDeleteFile(sprintf('Couldn\'t delete the "%s" file!', $fileLocation));
                }
            }
        } catch (FileNotFoundException $exception) {
            $this->logger->alert(sprintf('The file "%s" is missing!', $fileLocation));
        } catch (FilesystemException | UnableToDeleteFile $exception) {
            throw $exception;
        }
    }

    public function getUploadDirectory(): string
    {
        return $this->parameterBag->get('app.public_path') . $this->parameterBag->get('app.upload_dir');
    }
}