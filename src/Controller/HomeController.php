<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @Route("/{route}", name="vue_pages", requirements={"route"="^(?!.*api|_wdt|_profiler|login|logout|favicon|build).+"}, methods={"GET"})
     */
    public function homepage()
    {
        return $this->render('app.html.twig', [
            'bruh' => 'yass'
        ]);
    }
}