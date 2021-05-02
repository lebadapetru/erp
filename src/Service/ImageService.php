<?php


namespace App\Service;


use App\Entity\File;
use Liip\ImagineBundle\Service\FilterService;

class ImageService
{
    public function __construct(
        private FilterService $filterService,
        private FileStorage $fileStorage,
    )
    {}

    public function getPath(File $file, string $filter, array $config): string
    {
        $path = $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(
            $this->fileStorage->getRealFileLocation($file, false),
            $filter,
            $config
        );

        return str_replace(
            $this->fileStorage->getRelativeStoragePath() . '/',
            '',
            $path
        );
    }
}