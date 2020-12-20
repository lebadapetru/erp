<?php


namespace App\Controller\Security;


use App\Entity\EmailToken;
use App\Entity\User;
use App\Request\Security\VerifyRequest;
use App\Security\SecurityHelper;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->getConnection()->beginTransaction();
        try {
            $data = $request->all();
            /** @var $user User */
            $user = $entityManager
                ->getRepository(User::class)
                ->find(
                    $data['id']
                );

            if (!$user) {
                throw new NotFoundHttpException();
            }
            if ($user->isVerified()) {
                return new RedirectResponse('/');
            }

            $token = $entityManager
                ->getRepository(EmailToken::class)
                ->getActiveToken(
                    $data['token'],
                    $user->getId()
                );

            if (!$token) {
                throw new NotFoundHttpException(); //TODO maybe a token has expired exception?
            }

            $user->setVerifiedAt(Carbon::now());

            //remove all user's tokens after success
            $user->getEmailTokens()->clear();

            $entityManager->persist($user);
            $entityManager->flush();

            $securityHelper->authenticateUser($user, $request->getRequest());

            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
            /*TODO logs*/
        }

        return new RedirectResponse('/');
    }
}