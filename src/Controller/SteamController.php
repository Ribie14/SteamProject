<?php
namespace App\Controller;

use App\Entity\Games;
use App\Entity\User;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\JeuType;
use App\Form\EditProfileType;

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

    public function form(Games $jeux = null, Request $request,EntityManagerInterface $manager) {


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

            if($jeux->getId()){
               // $jeux->setCreatedAt(new \DataTime());
            }


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

      //  $comment = new Comment();
       // $form = $this->createForm(CommentType::class, $comment);

        return $this->render('steam/show.html.twig', [
            'jeux' => $jeux
            //'commentForm' => $form->createView()

        ]);
    }

    #[Route('/profile', name: 'profile')]

    public function profile() {
        return $this->render('steam/profile.html.twig');
    }

    #[Route('/inscription', name: 'inscription')]

    public function inscription() {
        return $this->render('steam/registration.html.twig');
    }

    #[Route('/editprofile',name: 'editprofile')]

    public function editprofile(Request $request) {

       // $username->getUsername();
        $User = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $User);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();

            $this->addFlash('message','Profil mis a jour');
            return $this->redirectToRoute('profile');
        }

        return $this->render('steam/editprofile.html.twig',[
            'form' => $form->createView(),
        ]);
    }


    #[Route('/editpass',name: 'editpass')]

    public function editpass(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('users');

            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('steam/editpass.html.twig');
    }

}
