<?php

namespace App\Controller;
use App\Form\PrestationType;
use App\Entity\Prestation;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrestationRepository;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(PrestationRepository $PrestationRepository): Response
    {
        $prestations = $PrestationRepository->findAll();
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestations,
        ]);
}
   #[Route('/register_prestation', name: 'app_register_prestation')]
   public function register_prestation(Request $request, EntityManagerInterface $entityManager): Response
   {
       $prestation = new Prestation();
       $form = $this->createForm(PrestationType::class, $prestation);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){
           $entityManager->persist($prestation);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'Your changes were saved!'
           );

           return $this->redirectToRoute('app_prestation');

       }

       return $this->render('prestation/register_prestation.html.twig',
       [
           'form' => $form,
       ]);

   }
}


