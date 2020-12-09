<?php


namespace App\Controller\User;


use App\Request\Register\VerifyRequest;
use App\Service\UserHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class VerifyEmailTokenController extends AbstractController
{
    /**
     * @Route ("/register/{id}/verify/{token}", methods={"GET"})
     * @param VerifyRequest $request
     * @param UserHelper $userHelper
     * @return RedirectResponse
     */
    public function execute(VerifyRequest $request, UserHelper $userHelper): RedirectResponse
    {
        $userHelper->verifyEmailToken(
            $request->getRequest()
        );

        return new RedirectResponse('/');
    }
}