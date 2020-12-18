<?php


namespace App\Controller\Security;


use App\Entity\User;
use App\Request\User\ForgotPasswordRequest;
use App\Security\ForgotPasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route ("/forgot-password", methods={"POST"})
     * @param ForgotPasswordRequest $request
     * @param ForgotPasswordService $service
     * @return JsonResponse
     */
    public function execute(
        ForgotPasswordRequest $request,
        ForgotPasswordService $service
    ): JsonResponse
    {
        $data = $request->all();
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $data['email']]);

        if (!$user) {
            throw new NotFoundHttpException('User could not be found.');
        }


        return new JsonResponse(
            'An email containing the password reset link has been sent to you',
            Response::HTTP_CREATED
        );
    }
}