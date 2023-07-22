<?php

namespace App\Controller\Admin;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/admin/genre', name: 'app_admin_genre')]
    public function index(GenreRepository $genreRepository): Response
    {

        $genre =$genreRepository->findAllGenresOrderBy();


        return $this->render('admin/genre/index.html.twig', [
            'genres' => $genre,
        ]);
    }
}
