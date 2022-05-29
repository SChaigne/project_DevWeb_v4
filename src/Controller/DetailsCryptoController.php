<?php

namespace App\Controller;

use App\Entity\CryptoCurrency;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsCryptoController extends AbstractController
{
    /**
     * @Route("/{_locale}details/{id}", name="app_details_crypto", methods={"GET"})
     */
    public function index(CryptoCurrency $cryptoCurrency): Response
    {
        $user = $this->getUser();
        $articles = $cryptoCurrency->getArticles();
        return $this->render('details_crypto/index.html.twig', [
            'crypto_currency' => $cryptoCurrency,
            'articles' => $articles,
            'user' => $user,
        ]);
    }
}
