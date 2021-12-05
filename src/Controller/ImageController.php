<?php


namespace App\Controller;


use App\Entity\File;
use App\Request\ImageRequest;
use App\Service\FileStorage;
use App\Service\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image/{id}/scale/{dimensions}/{name}", name="image", methods={"GET"})
     */
    public function scale(
        ImageRequest $request,
        ImageService $imageService,
        FileStorage $fileStorage,
    ): StreamedResponse
    {
        //TODO png filter takes too long, find why?
        //TODO add webp, gif, svg support
        $data = $request->all();

        $imageName = pathinfo($data['name'], PATHINFO_FILENAME);
        $imageExtension = pathinfo($data['name'], PATHINFO_EXTENSION);
        $filter = match ($imageExtension) {
            'jpg', 'jpeg' => 'jpg',
            'png' => 'png',
            'webp' => 'webp',
            default => throw new BadRequestHttpException('The image format is not supported.'),
        };

        preg_match('/^(\d+)?x(\d+)?$/i', $data['dimensions'], $dimensions);
        unset($dimensions[0]);
        $entityManager = $this->getDoctrine()->getManager();
        $file = $entityManager->getRepository(File::class)->find($data['id']);
        if (empty($dimensions)) {
            $dimensions[] = $file->getWidth();
            $dimensions[] = $file->getHeight();
        }

        $config = [
            'scale' => [
                'dim' => $dimensions
            ],
        ];

        $path = $imageService->generateRealPath($file, $filter, $config);

        return new StreamedResponse(
            function () use ($path, $file, $fileStorage) {
                $outputStream = fopen('php://output', 'wb');
                $stream = $fileStorage->readFromPath($path);

                stream_copy_to_stream($stream, $outputStream);
            },
            200,
            [
                'Content-Type' => File::ACCEPTED_MIME_TYPES['images'][$imageExtension]

            ]
        );
    }
}