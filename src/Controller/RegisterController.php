<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route ("/register", methods={"POST"})
     * @param Request $request
     */
    public function store(Request $request)
    {
        dd('wtf');
    }
}