<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SteamController extends AbstractController
{
<<<<<<< HEAD
    #[Route('/jeux', name: 'jeux')]
=======
    #[Route('/steamv2', name: 'steamv2')]
>>>>>>> 93979111377da3abdd5e48f0f150816ba442bf1b
    public function index(): Response
    {
        return $this->render('steam/index.html.twig', [
            'controller_name' => 'SteamController',
        ]);
    }

     //Permet de définir la page daccueil, la page basique du site

    #[Route('/', name: 'home')]

    public function home() {
        return $this->render('steam/home.html.twig');
    }

    #[Route('/jeux/12', name: 'jeux_show')]

    public function profile() {
        return $this->render('steam/show.html.twig');
    }
}
