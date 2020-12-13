<?php


namespace App\Controller\User;


use App\Request\User\RegisterRequest;
use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param RegisterRequest $request
     * @param RegisterService $service
     * @return JsonResponse
     * @throws \Exception
     */
    public function execute(RegisterRequest $request, RegisterService $service): JsonResponse
    {
        $service->register(
            $request->getRequest()
        );

        return new JsonResponse('Your registration was successful', Response::HTTP_CREATED);
    }
}