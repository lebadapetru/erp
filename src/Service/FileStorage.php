<?php


namespace App\Service;

use App\Entity\File;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UnableToWriteFile;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileStorage
{

    public function __construct(
        private ParameterBagInterface $parameterBag,
        private LoggerInterface $logger,
        private FilesystemOperator $defaultStorage
    )
    {
    }

    public function write(File $fileEntity): void
    {
        $fileLocation = $this->getRealFileLocation($fileEntity, false);
        /**@var UploadedFile $uploadedFile*/
        $uploadedFile = $fileEntity->getUploadedFile();
        try {
            /*TODO move files to s3*/
            $stream = fopen($uploadedFile->getRealPath(), 'r');
            $result = $this->defaultStorage->writeStream(
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

        //TODO once we move to s3 storage, we won't be able to use the File class since the resource is on cloud
        //and File accepts local resource path
        //return new HttpsFoundationFile($this->getAbsoluteStoragePath() . '/' . $fileLocation);
    }

    public function delete(File $fileEntity)
    {
        $fileLocation = $this->getRealFileLocation($fileEntity);
        try {
            if ($this->defaultStorage->fileExists($fileLocation)) {
                $result = $this->defaultStorage->delete($fileLocation);

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

    public function read(File $fileEntity)
    {
        $fileLocation = $this->getRealFileLocation($fileEntity);
        try {
            if ($this->defaultStorage->fileExists($fileLocation)) {
                $result = $this->defaultStorage->readStream($fileLocation);

                if ($result === false) {
                    throw new UnableToDeleteFile(sprintf('Couldn\'t read the "%s" file!', $fileLocation));
                }

                return $result;
            }

            return null;
        } catch (FileNotFoundException $exception) {
            $this->logger->alert(sprintf('The file "%s" is missing!', $fileLocation));
        } catch (FilesystemException | UnableToReadFile $exception) {
            throw $exception;
        }
    }

    public function readFromPath(string $path)
    {
        try {
            if ($this->defaultStorage->fileExists($path)) {
                $result = $this->defaultStorage->readStream($path);
                if ($result === false) {
                    throw new UnableToDeleteFile(sprintf('Couldn\'t read the "%s" file!', $fileLocation));
                }

                return $result;
            }

            return null;
        } catch (FileNotFoundException $exception) {
            $this->logger->alert(sprintf('The file "%s" is missing!', $fileLocation));
        } catch (FilesystemException | UnableToReadFile $exception) {
            throw $exception;
        }
    }

    public function getRelativeStoragePath(): string
    {
        return $this->parameterBag->get('app.upload_path');
    }

    public function getAbsoluteStoragePath(): string
    {
        return $this->parameterBag->get('kernel.project_dir') .
            '/public/' .
            $this->parameterBag->get('app.storage_dir') . '/' .
            $this->parameterBag->get('app.upload_dir');
    }

    public function getFileLocation(File $fileEntity, bool $withBaseUrl = true, bool $withFile = true): string
    {
        return
            ($withBaseUrl ? $this->parameterBag->get('app.url') : '') . //TODO this will be the s3 base url
            $this->getRelativeStoragePath() . '/' .
            $fileEntity->getId() . '/' .
            ($withFile ? ($fileEntity->getOriginalName() . '.' . $fileEntity->getExtension()) : '');
    }

    public function getRealFileLocation(File $fileEntity, bool $withAbsolutePath = true, bool $withFile = true): string
    {
        return
            ($withAbsolutePath ? $this->getAbsoluteStoragePath() . '/'  : '') . //TODO this will be the s3 base url
            $fileEntity->getId() . '/' .
            ($withFile ? ( $fileEntity->getOriginalName() . '.' . $fileEntity->getExtension()) : '');
    }
}