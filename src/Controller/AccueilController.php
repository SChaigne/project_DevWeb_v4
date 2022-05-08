<?php

namespace App\Controller;

use App\Service\CryptoCurrencyService;
use App\Entity\CryptoCurrency;
use App\Repository\CryptoCurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Scripts;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyService $cryptoService, CryptoCurrencyRepository $cryptoRepository): Response
    {
        $cryptos = $this->getDoctrine()->getRepository(CryptoCurrency::class)->findAll(); //Get All Crypto from DB

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'cryptos' => $cryptos
        ]);
    }

    /**
     *
     * @Route("/maj_crypto_test", name="maj_crypto_API")
     *
     */
    public function updateDataCryptoApi(CryptoCurrencyService $cryptoService, CryptoCurrencyRepository $cryptoRepository)
    {
        $em = $this->getDoctrine()->getManager();
        // $cryptoRepository->resetDatabase($em);
        $cryptoService->insertDataAPIBD($cryptoService, $em, $cryptoRepository);
?>
        <script>
            window.location.replace('/accueil');
        </script> <?php
                }
            }
