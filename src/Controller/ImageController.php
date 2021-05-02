<?php


namespace App\Controller;


use App\Entity\File;
use App\Request\ImageRequest;
use App\Service\FileStorage;
use App\Service\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image/{id}/scale/{size}/{name}", name="image", methods={"GET"})
     */
    public function index(
        ImageRequest $request,
        ImageService $imageService,
        FileStorage $fileStorage,
    )
    {
        $data = $request->all();

        $size = explode('x', $data['size']);
        $config = [
            'scale' => [
                'dim' => $size
            ],
        ];
        $entityManager = $this->getDoctrine()->getManager();
        $file = $entityManager->getRepository(File::class)->find($data['id']);
        $path = $imageService->getPath($file, 'my_thumb', $config);

        return new StreamedResponse(
            function () use ($path, $file, $fileStorage) {
                $outputStream = fopen('php://output', 'wb');
                $stream = $fileStorage->readFromPath($path);

                stream_copy_to_stream($stream, $outputStream);
            },
            200,
            [
                'Content-Type' => $file->getMimeType()
            ]
        );
    }
}