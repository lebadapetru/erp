<?php


namespace App\Controller;

use App\Request\UploadRequest;
use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route ("/upload", methods={"POST"})
     * @param UploadRequest $request
     * @param UploadService $uploadManager
     * @return JsonResponse
     */
    public function execute(
        UploadRequest $request,
        UploadService $uploadManager
    ): JsonResponse
    {
        /*TODO set this as custom endpoint for api platform POST /files*/
        $data = $request->all();

        $uploadManager = $uploadManager->save($data['file']);

        return $this->json(
            ['detail' => 'The file has been uploaded.'],
            Response::HTTP_CREATED
        );
    }
}