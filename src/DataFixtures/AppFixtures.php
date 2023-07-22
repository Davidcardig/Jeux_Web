<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use App\Entity\User;
use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Genre;


class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $genres =["stratégie",'familiale',"ambiance","coopéeration"];

        for ($i = 0; $i<10; $i++){

            $genre = new Genre();
            $genre->setNom($genres[$i % count($genres)]);
            $genre->setPopularite($faker->numberBetween(0,10));
            $genre->setCouleur($faker->hexColor);
            $manager->persist($genre);


            $jeu = new Jeu();
            $jeu ->setNom($faker->streetName);
            $jeu ->setDateSortie($faker->dateTime);
            $jeu ->setGenre($genre);
            $jeu ->setDescription($faker->text(50));
            $manager->persist($jeu);

            $prestation = new Prestation();
            $prestation->setNom($faker->streetName);
            $prestation->setExtrait($faker->text(50));
            $prestation->setDescription($faker->text(50));
            $prestation->setRenumeration($faker->randomFloat(2, 0, 1000));
            $manager->persist($prestation);


        }
        $user = new User();
        $user->setEmail("user@gmail.com");
        $user->setNom($faker->name);
        $user->setPrenom($faker->firstName);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "123"));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail("admin@gmail.com");
        $user->setNom($faker->name);
        $user->setPrenom($faker->firstName);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "Crdg"));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);




        $manager->flush();
    }
}
