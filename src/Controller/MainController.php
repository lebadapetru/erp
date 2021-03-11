<?php


namespace App\Controller;


use App\Entity\File;
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
            'appUrl' => $this->getParameter('app.url'),
            'tinymceApiKey' => $this->getParameter('tinymce.api.key'),
            'fileConfiguration' => [
                'mimeTypes' => File::ACCEPTED_MIME_TYPES,
                'extensions' => File::ACCEPTED_EXTENSIONS,
            ],
            'user' => [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail()
            ],
        ]);
    }
}