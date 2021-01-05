<?php


namespace App\Controller\Security;


use App\Entity\EmailToken;
use App\Entity\User;
use App\Request\Security\VerifyRequest;
use App\Security\SecurityHelper;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
                ->findOneBy([
                    'user' => $user,
                    'token' => $data['token'],
                ]);

            if (!$token->isActive()) {
                throw new HttpException(Response::HTTP_GONE, 'Your token has expired.');
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