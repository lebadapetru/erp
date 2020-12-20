<?php


namespace App\Controller\Security;


use App\Entity\User;
use App\Event\PasswordResetEvent;
use App\Request\Security\ForgotPasswordRequest;
use App\Security\SecurityHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route ("/reset-password", methods={"POST"})
     * @param ForgotPasswordRequest $request
     * @param SecurityHelper $securityHelper
     * @param EventDispatcherInterface $dispatcher
     * @return JsonResponse
     * @throws \Exception
     */
    public function execute(
        ForgotPasswordRequest $request,
        SecurityHelper $securityHelper,
        EventDispatcherInterface $dispatcher
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

        $randomString = $securityHelper->resetPassword($user);

        $dispatcher->dispatch(new PasswordResetEvent($user, $randomString));

        return new JsonResponse(
            'An email containing the password reset link has been sent to you',
            Response::HTTP_OK
        );
    }
}