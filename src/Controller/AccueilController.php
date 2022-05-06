<?php

namespace App\Controller;

use App\Service\CryptoCurrencyService;
use App\Entity\CryptoCurrency;
use App\Repository\CryptoCurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyService $cryptoService, CryptoCurrencyRepository $cryptoRepository): Response
    {
        // $cryptos = ($cryptoService->getAllCrypto());     
        $em = $this->getDoctrine()->getManager();
        $cryptoRepository->resetDatabase($em);
        $cryptoService->insertDataAPIBD($cryptoService, $em);

        $cryptos = $this->getDoctrine()->getRepository(CryptoCurrency::class)->findAll();


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'cryptos' => $cryptos
        ]);
    }
}
