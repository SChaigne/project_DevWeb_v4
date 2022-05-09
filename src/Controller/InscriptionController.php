<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$userInfos = $form->getData();

            //return $this->redirectToRoute('accueil');

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response("login : ".$user->getLogin()."\n mdp : ".$user->getPassword());
        }

        return $this->render('inscription/index.html.twig', [
            'inscription_form' => $form->createView()
        ]);
    }
}
