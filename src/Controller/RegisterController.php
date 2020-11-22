<?php


namespace App\Controller;


use App\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param Request $request
     * @param RegisterService $register
     */
    public function store(Request $request, RegisterService $register)
    {
        $register->validate($request);
        dd($request->request->all());
    }
}