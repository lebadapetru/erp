<?php


namespace App\Service;


use App\Entity\File;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class ImageService
{
    public function __construct(
        private FilterService         $filterService,
        private FileStorage           $fileStorage,
        private RouterInterface       $routeCollection,
        private ParameterBagInterface $parameterBag
    )
    {
    }

    /**
     * This is used to generate the real path to the version of the file based on filter
     */
    public function generateRealPath(File $file, string $filter, array $config): string
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

    /**
     * This is used to generate the url mask for the consumers
     */
    public function generateUrl(File $file): string
    {
        return $this->parameterBag->get('app.url')
            .
            str_replace(
                ['{id}', '{dimensions}', '{name}'],
                [$file->getId(), '{widthxheight}', $file->getFullDisplayName()],
                $this->routeCollection->getRouteCollection()->get('image')->getPath()
            );
    }
}