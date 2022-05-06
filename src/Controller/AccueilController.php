<?php

namespace App\Controller;

use App\Service\CryptoCurrencyService;
use App\Entity\CryptoCurrency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyService $cryptoService): Response
    {
        $cryptos = ($cryptoService->getAllCrypto());
        //$cryptoService->storeDataDB();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'cryptos' => $cryptos->data
        ]);
    }
}
