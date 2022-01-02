<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\File;
use App\Service\ImageService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, DenormalizedIdentifiersAwareItemDataProviderInterface
{
    public function __construct(
        private CollectionDataProviderInterface $collectionDataProvider,
        private ItemDataProviderInterface $itemDataProvider,
        private ImageService $imageService,
    ) {}
    
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        /**@var File[] $files*/
        $files = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
        foreach ($files as $file) {
            $url = $this->imageService->generateUrl($file);
            $file->setUrl($url);
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

        $url = $this->imageService->generateUrl($file);
        $file->setUrl($url);

        return $file;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === File::class;
    }
}