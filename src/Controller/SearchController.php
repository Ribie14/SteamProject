<?php

namespace App\Controller;

use App\Entity\Games;
use App\Form\SearchGameType;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class SearchController extends AbstractController
{
    #[Route("/game/search", name: 'search_game')]
    
    public function searchGame(Request $request, GamesRepository $gamesRepository)
    {
        $games = [];
        
        $searchGameForm = $this->createForm(SearchGameType::class);
        
        if($searchGameForm->handleRequest($request)->isSubmitted() && $searchGameForm->isValid()) {
            $criteria = $searchGameForm->getData();

            $games = $gamesRepository->searchGame($criteria);

            //dd($games);
            
        }


        return $this->render('search/game.html.twig',[
            'search_form' => $searchGameForm->createView(),
            'games' => $games
        ]);
    }
}