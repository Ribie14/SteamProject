<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Games;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Comment;

class GamesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create("fr_fr");

        for($i = 0;$i <= 2;$i++) {
            $categorie = new Categorie();
            $categorie->setTitre($faker->sentence())
                      ->setDescription($faker->paragraph());

            $manager->persist($categorie); 
            
            for ($j = 1; $j <= mt_rand(4, 6); $j++){
                $jeux = new Games();

                $content = '</p>' . join($faker->paragraphs(5), '</p><p>').'</p>';

                $jeux = new Games();
                $jeux -> setTitre($faker->sentence())
                      -> setCreateur("Créateur du jeu n°$i")
                      -> setDescription($content)
                      -> setPrix(mt_rand(0,20))
                      -> setDate($faker->dateTimeBetween('-6 months'))
                      -> setImage($faker->imageUrl())
                      ->setcategorie($categorie);

            $manager->persist($jeux);

                for($k = 1;$k <= mt_rand(4, 10); $k++){
                    $comment = new Comment();

                    $content = '</p>' . join($faker->paragraphs(5), '</p><p>').'</p>';

                    $now = new \DateTime();
                    $days = (new \DateTime())->diff($jeux->getCreatedAt())->days;

                    $comment->setAuteur($faker->name)
                            ->setContenue($content)
                            ->setCreatedAt($faker->dateTimeBetween("-" .$days . ' days'))
                            ->setJeu($jeux);

                    $manager->persist($comment);
                }
            }
        }

       
        $manager->flush();
    }
}
