<?php


namespace App\Controller;

use App\Service\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/users")
 */
class UserController
{

    /**
     * @Route ("/{id}/resend-verification-email", methods={"GET"})
     * @param RegisterService $service
     * @return JsonResponse
     */
    public function resendVerificationEmail(RegisterService $service)
    {
        $service->sendVerificationEmail();

        return new JsonResponse('The verification email has been sent', Response::HTTP_OK);
    }
}