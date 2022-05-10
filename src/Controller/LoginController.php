<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function index(Request $request): Response
    {

        $user = new User();
        $form = $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userInfos = $form->getData();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('login/index.html.twig', [
            'login_form' => $form->createView()
        ]);
    }
}
