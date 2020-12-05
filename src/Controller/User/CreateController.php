<?php


namespace App\Controller\User;


use App\Request\User\CreateRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateController extends AbstractController
{
    public function execute(CreateRequest $request)
    {
        $request->all();
    }
}