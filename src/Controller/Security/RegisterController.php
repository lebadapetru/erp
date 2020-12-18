<?php


namespace App\Controller\Security;


use App\Event\AccountCreatedEvent;
use App\Request\User\RegisterRequest;
use App\Security\RegisterService;
use App\Security\SecurityHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param RegisterRequest $request
     * @param RegisterService $service
     * @param EventDispatcherInterface $dispatcher
     * @param SecurityHelper $securityHelper
     * @return JsonResponse
     * @throws \Exception
     */
    public function execute(
        RegisterRequest $request,
        RegisterService $service,
        EventDispatcherInterface $dispatcher,
        SecurityHelper $securityHelper
    ): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->getConnection()->beginTransaction();
        try {
            $user = $service->createAccount($request->all());

            $securityHelper->authenticateUser($user, $request->getRequest());

            $dispatcher->dispatch(
                new AccountCreatedEvent($this->getUser()),
                AccountCreatedEvent::NAME
            );

            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
            /*TODO logs*/
        }

        return new JsonResponse(
            'Your registration was successful',
            Response::HTTP_CREATED
        );
    }
}