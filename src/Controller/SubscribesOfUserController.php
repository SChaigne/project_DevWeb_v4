<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscribesOfUserController extends AbstractController
{
    /**
     * @Route("/abonnements", name="app_subscribes_of_user")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        $subUser = $user->getSubscribes();
        $cryptoUser = array();
        foreach($subUser as $sub){
            foreach($sub->getIdCrypto() as $cryptoSub){
                array_push($cryptoUser,$cryptoSub);
            }
            
        }

        return $this->render('subscribes_of_user/index.html.twig', [
            'cryptos' => $cryptoUser,
        ]);
    }
}
