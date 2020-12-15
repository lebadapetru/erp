<?php


namespace App\Controller\Security;


use App\Request\User\VerifyRequest;
use App\Security\SecurityHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class VerifyEmailTokenController extends AbstractController
{
    /**
     * @Route ("/register/{id}/verify/{token}", methods={"GET"})
     * @param VerifyRequest $request
     * @param SecurityHelper $securityHelper
     * @return RedirectResponse
     * @throws \Exception
     */
    public function execute(VerifyRequest $request, SecurityHelper $securityHelper): RedirectResponse
    {
        $securityHelper->verifyEmailToken(
            $request->getRequest()
        );

        return new RedirectResponse('/');
    }
}