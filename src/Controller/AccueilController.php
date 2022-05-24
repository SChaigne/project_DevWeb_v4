<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Service\CryptoCurrencyService;
use App\Entity\CryptoCurrency;
use App\Form\SearchForm;
use App\Repository\CryptoCurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Scripts;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyRepository $cryptoRepository, Request $request): Response
    {

        $data = new SearchData;
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $cryptos = $cryptoRepository->findSearch($data); // Recupère les données filter (toute si aucun filtre)


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'cryptos' => $cryptos,
            'form' => $form->createView()
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
