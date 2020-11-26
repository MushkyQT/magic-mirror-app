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
        // Detect logged in user's userType or if no user logged in, default to none
        $userType = 'none';
        if ($this->getUser()) {
            $userType = $this->getUser()->getUserType();
        }

        if ($userType === 'aidant') {
            return $this->redirectToRoute('app_login');
        } elseif ($userType === 'habitant') {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('habitat/index.html.twig', [
                'controller_name' => 'HabitatController',
            ]);
        }
    }
}