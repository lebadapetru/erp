<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\FileOutput;
use App\Entity\File;
use App\Service\ImageService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileOutputDataTransformer implements DataTransformerInterface
{
    public function __construct(
        private ImageService $imageService,
        private ParameterBagInterface $parameterBag,
    )
    {}

    public function transform($object, string $to, array $context = [])
    {
        $output = new FileOutput();
        $url = $this->imageService->getUrl($object);
        $output->url = $this->parameterBag->get('app.url') . $url;

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof File && $to === FileOutput::class;
    }
}