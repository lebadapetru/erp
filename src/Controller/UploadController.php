<?php


namespace App\Controller;

use App\Request\UploadRequest;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route ("/upload", methods={"POST"})
     * @param UploadRequest $request
     * @param FileUploader $fileUploader
     * @return JsonResponse
     */
    public function execute(
        UploadRequest $request,
        FileUploader $fileUploader
    ): JsonResponse
    {
        $data = $request->all();
        $fileUploader->upload(
            $data['file']
        );

        return $this->json(
            ['detail' => 'The file has been uploaded.'],
            Response::HTTP_CREATED
        );
    }
}