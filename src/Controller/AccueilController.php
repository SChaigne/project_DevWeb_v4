<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Service\CryptoCurrencyService;
use App\Form\SearchForm;
use App\Repository\CryptoCurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class AccueilController extends AbstractController
{
    /**
     * @Route("{_locale}/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {
        $data = new SearchData;
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $cryptos = $cryptoRepository->findSearch($data); // Recupère les données filter (toute si aucun filtre)

        $user = $this->getUser();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'user' => $user,
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
        return $this->redirectToRoute('app_accueil');
    }


    /**
     * @Route("{_locale}/marketcap", name="app_stat")
     */
    public function statMarketCap(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {
        $crypto50 = $cryptoRepository->findMCInf500MM();
        $countCrypto50 = count($crypto50);
        $crypto50To500 = $cryptoRepository->findMCmin50Max500();
        $countCrypto50To500 = count($crypto50To500);
        $crypto500 = $cryptoRepository->findMCSup500();
        $countCrypto500 = count($crypto500);
        return $this->render(
            'accueil/statMarketCap.html.twig',
            [
                'countCrypto50' => $countCrypto50,
                'countCrypto50To500' => $countCrypto50To500,
                'countCrypto500' => $countCrypto500
            ]
        );
    }

    /**
     * @Route("{_locale}/marketcap/crypto50", name="app_stat_crypto50")
     */
    public function statMarketCapCrypto50M(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {
        $crypto50 = $cryptoRepository->findMCInf500MM();
        return $this->render(
            'subscribes_of_user/index.html.twig',
            [
                'cryptos' => $crypto50
            ]
        );
    }

    /**
     * @Route("{_locale}/marketcap/crypto50To500", name="app_stat_crypto50To500")
     */
    public function statMarketCapCrypto50To500(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {
        $crypto50To500 = $cryptoRepository->findMCmin50Max500();
        return $this->render(
            'subscribes_of_user/index.html.twig',
            [
                'cryptos' => $crypto50To500
            ]
        );
    }

    /**
     * @Route("{_locale}/marketcap/crypto500", name="app_stat_crypto500")
     */
    public function statMarketCapCrypto500(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {
        $crypto500 = $cryptoRepository->findMCSup500();
        return $this->render(
            'subscribes_of_user/index.html.twig',
            [
                'cryptos' => $crypto500
            ]
        );
    }
}
