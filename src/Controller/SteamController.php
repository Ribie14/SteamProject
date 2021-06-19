<?php

namespace App\Controller;

use App\Entity\Games;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SteamController extends AbstractController
{
    #[Route('/jeux', name: 'jeux')]
    public function index(GamesRepository $repo): Response
    {

        $jeux = $repo->findAll();
        return $this->render('steam/index.html.twig', [
            'controller_name' => 'SteamController', 
            'jeux' => $jeux
        ]);
    }

     //Permet de définir la page daccueil, la page basique du site

    #[Route('/', name: 'home')]

    public function home() {
        return $this->render('steam/home.html.twig'); 
       
    } 
    
    #[Route('/publication',name: 'publication_jeux')]

    public function publication(Request $request,EntityManagerInterface $manager) {
        $jeux = new Games();

        $form = $this->createFormBuilder($jeux)
                     ->add('Titre')
                     ->add('createur')
                     ->add('description')
                     ->add('Prix')
                     ->add('categorie')
                     ->add('Date')
                     ->add('image')
                     ->getForm();
        
        return $this->render('steam/publication.html.twig',[
            'formJeux' => $form->createView()
        ]);
    }

    #[Route('/jeux/{id}', name: 'jeux_show')]

    public function show(Games $jeux) {

        return $this->render('steam/show.html.twig',[
            'jeux' => $jeux
         
        ]);
    }

   
}
