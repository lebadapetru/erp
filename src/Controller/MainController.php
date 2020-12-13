<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main", methods={"GET"})
     * @Route(
     *     "/{route}",
     *     name="vue_pages",
     *     requirements={"route"="^(?!.*api|_wdt|_profiler|login|logout|register|forgot-password|verify|favicon|build).+"},
     *     methods={"GET"})
     */
    public function index()
    {
        return $this->render('app.html.twig', [
            'appUrl' => $this->getParameter('app.url')
        ]);
    }
}