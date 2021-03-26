<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\FileOutput;
use App\Entity\File;

class FileOutputDataTransformer implements DataTransformerInterface
{
    /**@param File $object*/
    public function transform($object, string $to, array $context = []): object
    {
        /**@var FileOutput $output*/
        $output = new FileOutput();
        $output->name = $object->getName();
        $output->extension = $object->getExtension();
        $output->mimeType = $object->getMimeType();
        $output->size = $object->getSize();
        $output->width = $object->getWidth();
        $output->height = $object->getHeight();
        $output->mediaUrl = $object->getMediaUrl();
        $output->path = $object->getPath();
        $output->deletedAt = $object->getDeletedAt();
        $output->updatedAt = $object->getUpdatedAt();
        $output->createdAt = $object->getCreatedAt();

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return FileOutput::class === $to && $data instanceof File;
    }
}