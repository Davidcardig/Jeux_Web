<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use App\Entity\User;
use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


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

       $jeu = new Jeu();
       $jeu ->setNom($faker->streetName);
       $jeu ->setDateSortie($faker->dateTime);
       $jeu ->setGenre($genres[rand(0,3)]);
       $jeu ->setDescription($faker->text(50));
       $manager->persist($jeu);

       $prestation = new Prestation();
       $prestation->setNom($faker->streetName);
       $prestation->setExtrait($faker->text(50));
       $prestation->setDescription($faker->text(50));
       $prestation->setNumberPhone($faker->phoneNumber);
       $prestation->setRenumeration($faker->randomFloat(2, 0, 1000));
       $prestation->setDateCreation($faker->dateTime);
       $manager->persist($prestation);


        }
        $user = new User();
        $user->setEmail("user@gmail.com");
        $user->setNom($faker->name);
        $user->setPrenom($faker->firstName);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "123"));
        $user->setDateInscription($faker->dateTime);
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);




       $manager->flush();
    }
}
