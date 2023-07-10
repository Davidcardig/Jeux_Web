<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(JeuRepository $jeuRepository): Response
    {
        $jeux = $jeuRepository->findJeuxWithLimitedNumber(3);


        return $this->render('jeux/index.html.twig', [
           'jeux' => $jeux
        ]);


    }
}
