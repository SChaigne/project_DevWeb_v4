<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class NavigationController extends AbstractController // https://www.univ-orleans.fr/iut-orleans/informatique/intra/tuto/php/symfony-securitybundle-auth.html
{
    /**
     * @Route("/navigation", name="app_navigation")
     */
    public function index(): Response
    {
        return $this->render('navigation/index.html.twig', [
            'controller_name' => 'NavigationController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->redirectToRoute('app_accueil');
    }

    // /**
    //  * Nécessite juste d'être connecté
    //  * @Route("/membre", name="membre")
    //  * @IsGranted("IS_AUTHENTICATED_FULLY")
    //  * fonctionne aussi avec ROLE_USER
    //  */
    public function membre()
    {
        return $this->render('navigation/membre.html.twig');
    }


    /**
     * Besoin des droits admin
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        // * @IsGranted("ROLE_ADMIN")

        //récupération de l'utilisateur security>Bundle // A mettre au dessus
        $utilisateur = $this->getUser();

        //vérification des droits.
        // if ($utilisateur && in_array('ROLE_ADMIN', $utilisateur->getRoles())) {//TODO a decommenter une fois le menu admin fini
        return $this->render('navigation/admin.html.twig');
        // }//TODO a decommenter une fois le menu admin fini

        //redirection
        // $session->set("message", "Vous n'avez pas le droit d'acceder à la page admin vous avez été redirigé sur cette page");
        // return $this->redirectToRoute('home'); //TODO a decommenter une fois le menu admin fini
    }
}
