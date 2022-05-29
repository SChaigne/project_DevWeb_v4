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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(CryptoCurrencyRepository $cryptoRepository, Request $request, TranslatorInterface $translator): Response
    {

        $data = new SearchData;
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $cryptos = $cryptoRepository->findSearch($data); // Recupère les données filter (toute si aucun filtre)

        // XXX A ne pas décommenter sauf pour test
        // dd($cryptos);
        // $cryptos = $this->getDoctrine()->getRepository(CryptoCurrency::class)->findAll(); //Get All Crypto from DB
        // XXX

        $user = $this->getUser();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'user' => $user,
            'cryptos' => $cryptos,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        // On stocke la langue dans la session
        $request->getSession()->set('_locale', $locale);

        // On revient sur la page précédente
        return $this->redirect($request->headers->get('referer'));
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
