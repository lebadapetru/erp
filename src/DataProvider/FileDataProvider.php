<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\File;
use App\Service\FileStorage;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, DenormalizedIdentifiersAwareItemDataProviderInterface
{
    public function __construct(
        private CollectionDataProviderInterface $collectionDataProvider,
        private ItemDataProviderInterface $itemDataProvider,
        private FilterService $filterService,
        private ParameterBagInterface $parameterBag,
        private FileStorage $fileStorage,
    ) {}
    
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        /**@var File[] $files*/
        $files = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
        foreach ($files as $file) {
            $fileLocation = $this->fileStorage->getRealFileLocation($file, false);
            $image = $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(
                $fileLocation,
                'my_thumb',
                ['thumbnail' => ['size' => [60, 60]]]
            );
            dd($image);
            $file->setPath(
              $this->parameterBag->get('app.url') . $file->getPath()
            );
        }

        return $files;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?object
    {
        /**@var File $file*/
        $file = $this->itemDataProvider->getItem($resourceClass, $id, $operationName, $context);

        if (!$file) {
            return null;
        }

        /*$file->setPath(
            $this->parameterBag->get('app.url') . $file->getPath()
        );*/

        return $file;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === File::class;
    }
}