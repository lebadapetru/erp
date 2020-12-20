<?php


namespace App\Controller\Security;


use App\Event\AccountCreatedEvent;
use App\Event\VerificationEmailRequestedEvent;
use App\Security\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class SendVerificationEmailController extends AbstractController
{
    /**
     * @Route ("/send-verification-email", methods={"GET"})
     * @param EventDispatcherInterface $dispatcher
     * @return JsonResponse
     */
    public function execute(EventDispatcherInterface $dispatcher): JsonResponse
    {
        $dispatcher->dispatch(
            new VerificationEmailRequestedEvent($this->getUser())
        );

        return new JsonResponse('The verification email has been sent', Response::HTTP_OK);
    }
}