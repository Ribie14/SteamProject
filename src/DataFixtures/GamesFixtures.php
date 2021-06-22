<?php

namespace App\DataFixtures;

use App\Entity\Games;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GamesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 2; $i++){
            $jeux = new Games();
            $jeux -> setTitre("Nom jeux n°$i")
                -> setCreateur("Créateur du jeu n°$i")
                -> setDescription("Description du jeu n°$i")
                -> setPrix(mt_rand(0,20))
                -> setCategorie("la catégorie du jeu n°$i est : ")
                -> setDate(new \DateTime())
                -> setImage("http://placehold.it/350x150")
                -> setTéléchargement(mt_rand(0,10));

            $manager->persist($jeux);
        } 

        $manager->flush();
    }
}
