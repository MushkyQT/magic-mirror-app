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
        // If user has habitat(s), pass them to list_habitats
        // Else, redirect to add new habitat page with a flash message
        $user = $this->getUser();
        if ($user->getHabitats()[0]) {
            $habitats = $user->getHabitats();
            return $this->render('habitat/list_habitats.html.twig', [
                'habitats' => $habitats,
            ]);
        } else {
            $this->addFlash('error', 'No habitats! Please add your first habitat.');
            return $this->redirectToRoute('app_new_habitat');
        }
    }

    /**
     * @Route("/habitats/new", name="app_new_habitat")
     * @IsGranted("ROLE_USER")
     */
    public function newHabitat(Request $request): Response
    {
        // Prepare new Habitat and create/handle Add Habitat form
        $habitat = new Habitat();
        $form = $this->createForm(AddHabitatFormType::class, $habitat);
        $form->handleRequest($request);

        /* If form was submitted and is valid, persist new habitat and
        create user_habitat relationship and redirect to habitats list */
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $habitat->addUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->redirectToRoute('app_list_habitats');
        }

        return $this->render('habitat/new_habitat.html.twig', [
            'controller_name' => 'HabitatController',
            'addHabitatForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/habitats/{id}", name="app_view_habitat")
     * @IsGranted("ROLE_USER")
     */
    public function showHabitat(Habitat $habitat): Response
    {
        // Check if user has relationship with requested habitat
        // If no, redirect away with flash message.
        $user = $this->getUser();
        if (!$habitat->getUsers()->contains($user)) {
            $this->addFlash('error', 'You do not have access to this habitat!');
            return $this->redirectToRoute('app_list_habitats');
        }

        // If yes, render page.
        return $this->render('habitat/show_habitat.html.twig', [
            'habitat' => $habitat,
        ]);
    }
}