<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $genres =["stratégie",'familiale',"ambiance","coopéeration"];

        for ($i = 0; $i<10; $i++){

       $jeu = new Jeu();
       $jeu ->setNom($faker->streetName);
       $jeu ->setDateSortie($faker->dateTime);
       $jeu ->setGenre($genres[rand(0,3)]);
       $jeu ->setDescription($faker->text(50));
       $manager->persist($jeu);

        }

       $manager->flush();
    }
}
