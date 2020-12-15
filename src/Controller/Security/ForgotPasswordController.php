<?php


namespace App\Controller\User;


use App\Request\User\ForgotPasswordRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route ("/forgot-password", methods={"POST"})
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function execute(ForgotPasswordRequest $request): JsonResponse
    {


        return new JsonResponse('An email containing the password reset link has been sent to you', Response::HTTP_CREATED);
    }
}