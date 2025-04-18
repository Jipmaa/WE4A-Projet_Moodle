<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; // Import the Response class
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted; // Import IsGranted

class PageController extends AbstractController
{
    #[Route('/tableau-de-bord', name: 'tableau_de_bord')]
    public function tableaudebord(): Response // Add the return type
    {
        return $this->render('tableaudebord.html.twig');
    }


    #[Route('/creation-post', name: 'creation_post')]
    public function creationPost(): Response  // Add the return type
    {
        return $this->render('creation/creationpost.html.twig');
    }


    #[Route('/creation-ue', name: 'creation_ue')]
    public function creationUe(): Response  // Add the return type
    {
        return $this->render('creation/creationue.html.twig');
    }


    #[Route('/creation-user', name: 'creation_user')]
    public function creationUser(): Response  // Add the return type
    {
        return $this->render('creation/creationuser.html.twig');
    }


    #[Route('/gestions-posts', name: 'gestion_posts')]
    public function gestionPosts(): Response  // Add the return type
    {
        return $this->render('gestion/gestion_posts.html.twig');
    }


    #[Route('/gestion-du-compte', name: 'gestion_du_compte')]
    public function gestionDuCompte(): Response  // Add the return type
    {
        return $this->render('gestion/gestionducompte.html.twig');
    }


    #[Route('/pageadmin', name: 'page_admin')]
    public function pageAdmin(): Response  // Add the return type
    {
        return $this->render('pageadmin.html.twig');
    }

    #[Route('/mon-compte', name: 'mon_compte')]
    public function monCompte(): Response  // Add the return type
    {
        return $this->render('moncompte.html.twig');
    }

    #[Route('/', name: 'mescours')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login'); // Corrected route name.  Use the name of your login route.  It's often app_login in Symfony
        }

        // Si l'utilisateur est connecté, on affiche la page mescours
        return $this->render('mescours.html.twig');
    }
}
