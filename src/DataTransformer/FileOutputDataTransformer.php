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

    /**
     * @param File $object
    */
    public function transform($object, string $to, array $context = []): FileOutput
    {
        $output = new FileOutput();

        $output->id = $object->getId();
        $output->realName = $object->getRealName();
        $output->displayName = $object->getDisplayName();
        $output->extension = $object->getExtension();
        $output->fullRealName = $object->getFullRealName();
        $output->fullDisplayName = $object->getFullDisplayName();
        $output->size = $object->getSize();
        $output->mimeType = $object->getMimeType();
        $output->url = $this->parameterBag->get('app.url') . $this->imageService->getUrl($object);

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof File && $to === FileOutput::class;
    }
}