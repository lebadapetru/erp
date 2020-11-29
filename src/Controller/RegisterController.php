<?php


namespace App\Controller;


use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/register")
 */
class RegisterController extends AbstractController
{
    /**
     * @Route ("", methods={"POST"})
     * @param Request $request
     * @param RegisterService $service
     * @return JsonResponse
     */
    public function create(Request $request, RegisterService $service)
    {
        $service->register($request);

        return new JsonResponse('Your registration was successful', Response::HTTP_CREATED);
    }

    /**
     * @Route ("/{id}/verify/{token}", methods={"GET"})
     * @param Request $request
     * @param RegisterService $service
     * @return RedirectResponse
     */
    public function verify(Request $request, RegisterService $service)
    {
        $service->verifyEmail($request);

        return new RedirectResponse('/');
    }
}