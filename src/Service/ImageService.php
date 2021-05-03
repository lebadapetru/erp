<?php


namespace App\Service;


use App\Entity\File;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class ImageService
{
    public function __construct(
        private FilterService $filterService,
        private FileStorage $fileStorage,
        private RouterInterface $routeCollection,
    )
    {}

    public function getPath(File $file, string $filter, array $config): string
    {
        $path = $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(
            $this->fileStorage->getRealFileLocation($file, false),
            $filter,
            $config
        );

        //$path is generated as `/storage/upload/media/cache/{etc} by liipimagine
        //remove the `/storage/upload/` because it will get appended with this prefix already
        return str_replace(
            $this->fileStorage->getRelativeStoragePath() . '/',
            '',
            $path
        );
    }

    public function getUrl(File $file)
    {
        return str_replace(
            ['{id}', '{size}', '{name}'],
            [$file->getId(), '{widthxheight}', $file->getFileFullDisplayName()],
            $this->routeCollection->getRouteCollection()->get('image')->getPath()
        );
    }
}