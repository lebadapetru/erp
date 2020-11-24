<?php


namespace App\Controller;


use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param Request $request
     * @param RegisterService $register
     * @return JsonResponse
     */
    public function store(Request $request, RegisterService $register)
    {
        $register->validate($request);
        $register->save($request);
        $register->sendVerificationEmail($request->request->get('email'));

        return new JsonResponse([
            'Your registration was successful'
        ], Response::HTTP_CREATED);
    }
}