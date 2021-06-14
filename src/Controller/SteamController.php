<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SteamController extends AbstractController
{
    #[Route('/jeux', name: 'jeux')]
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
