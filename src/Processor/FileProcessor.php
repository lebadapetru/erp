<?php

namespace App\Processor;

use App\Controller\File\CreateFileAction;
use App\Dao\FileDao;
use App\Entity\File;
use Imagick;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileProcessor
{
    public function __construct(
        private SluggerInterface $slugger
    )
    {
    }

    public function processParamsForCreate(array $params): array
    {
        $processedParams = [];

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $params[CreateFileAction::PARAM_KEY_FILE];

        $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        //this one does strtolower, sanitization
        $fileName = $this->slugger->slug($originalFileName) . '-' . uniqid();

        $processedParams[FileDao::COL_REAL_NAME]    = $fileName;
        $processedParams[FileDao::COL_DISPLAY_NAME] = $fileName;
        $processedParams[FileDao::COL_EXTENSION]    = $uploadedFile->guessExtension();
        $processedParams[FileDao::COL_MIME_TYPE]    = $uploadedFile->getMimeType();
        $processedParams[FileDao::COL_SIZE]         = $uploadedFile->getSize();
        $processedParams[FileDao::COL_STATUS]       = File::STATUS_PROCESSING;

        return $processedParams;
    }

    public function processParamsForSaveImage(Imagick $image)
    {

    }
}