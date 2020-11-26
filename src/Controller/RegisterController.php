<?php


namespace App\Controller;


use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param Request $request
     * @param RegisterService $registerService
     * @return JsonResponse
     */
    public function create(RegisterService $registerService)
    {
        $registerService
            ->validateRequest()
            ->createAccount();

        $registerService->sendVerificationEmail();

        return new JsonResponse('Your registration was successful', Response::HTTP_CREATED);
    }

    /**
     * @Route ("/resend-verification-email", methods={"GET"})
     * @param RegisterService $registerService
     * @return JsonResponse
     */
    public function resendVerificationEmail(RegisterService $registerService)
    {
        $registerService->sendVerificationEmail();

        return new JsonResponse('The verification email has been sent', Response::HTTP_OK);
    }

    /**
     * @Route ("/verify/{id}/{token}", methods={"GET"})
     * @param Request $request
     * @param RegisterService $register
     * @return JsonResponse
     */
    public function verify(Request $request, RegisterService $register)
    {
        $routeParams = $request->attributes->get('_route_params');
        $register->verifyEmail(
            $routeParams['id'],
            $routeParams['token'],
        );

        return new JsonResponse('The email verification was successful', Response::HTTP_OK);
    }
}