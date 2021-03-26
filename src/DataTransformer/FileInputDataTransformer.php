<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\File;
use App\Service\UploadService;

class FileInputDataTransformer implements DataTransformerInterface
{

    public function __construct(
        private UploadService $uploadService
    ) {}

    public function transform($object, string $to, array $context = []): object
    {
        dump($this->uploadService->save($object->file));
        return new File();

    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof File) {
            // already transformed
            return false;
        }

        return File::class === $to && null !== ($context['input']['class'] ?? null);
    }
}