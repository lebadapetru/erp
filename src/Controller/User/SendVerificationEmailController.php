<?php


namespace App\Controller\User;


use App\Service\UserHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SendVerificationEmailController extends AbstractController
{
    /**
     * @Route ("/send-verification-email", methods={"GET"})
     * @param UserHelper $userHelper
     * @return JsonResponse
     */
    public function execute(UserHelper $userHelper): JsonResponse
    {
        $userHelper->sendVerificationEmail();

        return new JsonResponse('The verification email has been sent', Response::HTTP_OK);
    }
}