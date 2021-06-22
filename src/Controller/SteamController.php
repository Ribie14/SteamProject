<?php
namespace App\Controller;

use App\Entity\Games;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\JeuType;

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
    #[Route('/publication/{id}/edit',name: 'publication_edit')]

    public function form(Request $Request, Games $jeux = null, Request $request,EntityManagerInterface $manager) {


        if(!$jeux){
            $jeux = new Games();
        }
        

        //$form = $this->createFormBuilder($jeux)
          //           ->add('Titre')
           //          ->add('createur')
            //         ->add('description')
            //         ->add('Prix')
              //       ->add('categorie')
               //      ->add('image')
                 //   ->getForm();

        $form = $this->createForm(JeuType::class, $jeux);

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){


            $manager->persist($jeux);
            $manager->flush();

            return $this->redirectToRoute('publication_jeux', ['id' => $jeux->getId
            ()]);
        }

        return $this->render('steam/publication.html.twig',[
            'formJeux' => $form->createView(),
            'editMode' => $jeux->getId() !== null
        ]);
    }

    #[Route('/jeux/{id}', name: 'jeux_show')]

    public function show(Games $jeux) {

        //$comment = new Comment();
        //$form = $this->createForm(CommentType::class, $comment);

        return $this->render('steam/show.html.twig', [
            'jeux' => $jeux
           // 'commentForm' => $form->createView()

        ]);
    }

    #[Route('/profile', name: 'profile')]

    public function profile() {
        return $this->render('steam/profile.html.twig');
    }

   
}
