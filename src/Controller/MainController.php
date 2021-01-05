<?php


namespace App\Controller;


use App\Entity\User;
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
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        /** @var $user User */
        $user = $this->getUser();

        return $this->render('app.html.twig', [
            'app_url' => $this->getParameter('app.url'),
            'user' => [
                'id' => $user->getId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail()
            ],
        ]);
    }
}