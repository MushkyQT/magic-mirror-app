<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HabitatController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('habitat/index.html.twig', [
                'controller_name' => 'HabitatController',
            ]);
        }
    }
}