<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/ajouter', name: 'app_admin_genre_ajouter')]
    #[Route('/modifier/{id}', name: 'app_admin_genre_modifier')]
    public function editer(Request $request,GenreRepository $genreRepository, EntityManagerInterface $entityManager, int $id = null): Response
    {

        if($request->attributes->get('_route') == 'app_admin_genre_ajouter'){
            $genre = new Genre();
        }else{
            $genre = $genreRepository->find($id);
        }

        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($genre);
            $entityManager->flush();


            if($request->attributes->get('_route') == 'app_admin_genre_ajouter'){
            $this->addFlash(
                'success',
                'Le nouveau genre a bien été ajouté !'
            ); }else{
                $this->addFlash(
                    'success',
                    'Le genre a bien été modifié !'
                );
            }

            return $this->redirectToRoute('app_admin_genre');


        }


        return $this->renderForm('admin/genre/editer.html.twig', [
            'form' => $form
        ]);

    }



    #[Route('/supprimer/{id}', name: 'app_admin_genre_supprimer')]
    public function supprimer(GenreRepository $genreRepository, EntityManagerInterface $entityManager, int $id): Response
    {

        $genre = $genreRepository->find($id);
        $entityManager->remove($genre);
        $entityManager->flush();

        $this->addFlash(
            'success',
            "Le genre a bien été supprimé !"
        );

        return $this->redirectToRoute('app_admin_genre');

    }

}
