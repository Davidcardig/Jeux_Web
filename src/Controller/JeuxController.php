<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Jeu;
use App\Form\GenreType;
use App\Form\JeuType;
use App\Repository\GenreRepository;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/admin/jeux', name: 'app_admin_jeux')]
    public function jeux_admin(JeuRepository $jeuRepository): Response
    {
        $jeux = $jeuRepository->findAll();


        return $this->render('admin/jeux/index.html.twig', [
            'jeux' => $jeux
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_jeux_ajouter')]
    #[Route('/modifier/{id}', name: 'app_admin_jeux_modifier')]
    public function editer(Request $request,JeuRepository $jeuRepository, EntityManagerInterface $entityManager, int $id = null): Response
    {

        if($request->attributes->get('_route') == 'app_admin_jeux_ajouter'){
            $jeux = new Jeu();
        }else{
            $jeux = $jeuRepository->find($id);
        }

        $form = $this->createForm(JeuType::class, $jeux);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($jeux);
            $entityManager->flush();


            if($request->attributes->get('_route') == 'app_admin_jeux_ajouter'){
                $this->addFlash(
                    'success',
                    'Le nouveau jeu a bien été ajouté !'
                ); }else{
                $this->addFlash(
                    'success',
                    'Le jeu a bien été modifié !'
                );
            }

            return $this->redirectToRoute('app_admin_jeux');


        }


        return $this->renderForm('admin/jeux/editer.html.twig', [
            'form' => $form
        ]);

    }



    #[Route('/supprimer/{id}', name: 'app_admin_jeux_supprimer')]
    public function supprimer(JeuRepository $jeuRepository, EntityManagerInterface $entityManager, int $id): Response
    {

        $jeux = $jeuRepository->find($id);
        $entityManager->remove($jeux);
        $entityManager->flush();

        $this->addFlash(
            'success',
            "Le jeux a bien été supprimé !"
        );

        return $this->redirectToRoute('app_admin_jeux');

    }


}
