<?php


namespace App\Controller\Security;


use App\Security\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SendVerificationEmailController extends AbstractController
{
    /**
     * @Route ("/send-verification-email", methods={"GET"})
     * @param RegisterService $service
     * @return JsonResponse
     */
    public function execute(RegisterService $service): JsonResponse
    {
        $service->sendAccountVerificationEmail();

        return new JsonResponse('The verification email has been sent', Response::HTTP_OK);
    }
}