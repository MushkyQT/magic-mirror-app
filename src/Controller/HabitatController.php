<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Form\AddHabitatFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            return $this->redirectToRoute('app_list_habitats');
        } elseif ($userType === 'habitant') {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('habitat/index.html.twig', [
                'controller_name' => 'HabitatController',
            ]);
        }
    }

    /**
     * @Route("/habitats", name="app_list_habitats")
     * @IsGranted("ROLE_USER")
     */
    public function listHabitats(): Response
    {
        // TODO: If user has no habitats, redirect to app_new_habitat with a flash
        $this->addFlash('error', 'No habitats! Please add your first habitat.');
        return $this->redirectToRoute('app_new_habitat');


        // TODO: If user has habitats, list them
        // Do me

        return $this->render('habitat/list_habitats.html.twig', [
            'controller_name' => 'HabitatController',
        ]);
    }

    /**
     * @Route("/habitats/new", name="app_new_habitat")
     * @IsGranted("ROLE_USER")
     */
    public function newHabitat(Request $request): Response
    {
        $habitat = new Habitat();
        $form = $this->createForm(AddHabitatFormType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habitat);
            $entityManager->flush();
        }

        return $this->render('habitat/new_habitat.html.twig', [
            'controller_name' => 'HabitatController',
            'addHabitatForm' => $form->createView(),
        ]);
    }
}