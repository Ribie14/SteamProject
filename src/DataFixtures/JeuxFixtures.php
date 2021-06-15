<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Jeux;


class JeuxFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for ($i = 1; $i <= 10; $i++){
            $jeux = new Jeux();
            $jeux -> setName("Nom jeux n°$i")
                -> setCreateur("Créateur du jeu n°$i")
                -> setDescription("<p>Description du jeu n°$i</p>")
                -> setPrix("Le prix du jeux n°$i est : ")
                -> setCategorie("la catégorie du jeu n°$i est : ")
                -> setTelechargement("le jeu n°$i a été téléchergé n fois");
        } 

        $manager->flush();
    }
}
