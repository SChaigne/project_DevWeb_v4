<?php

namespace App\Controller;

use App\Entity\CryptoCurrency;
use App\Entity\Subscribe;
use App\Form\SubscribeType;
use App\Repository\SubscribeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//@IsGranted("ROLE_MEMBRE") (//TODO a mettre quand j'aurais les users)
/**
 * @Route("/subscribe")
 */
class SubscribeController extends AbstractController
{
    /**
     * @Route("/", name="app_subscribe_index", methods={"GET"})
     */
    public function index(SubscribeRepository $subscribeRepository): Response
    {
        return $this->render('subscribe/index.html.twig', [
            'subscribes' => $subscribeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id_crypto}", name="app_subscribe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SubscribeRepository $subscribeRepository, $id_crypto): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }

        // ON RECUPERE LA CRYPTO
        // (normalement il y a un moyen plus simple de le faire mais j'y arrive pas...)
        $crypto = $this->getDoctrine()->getRepository(CryptoCurrency::class)->findOneBy(['id' => $id_crypto]);
        $subscribe = new Subscribe();
        $subscribe->addIdUser($user);
        $subscribe->addIdCrypto($crypto);

        $subscribeRepository->add($subscribe);
        // return $this->redirectToRoute('app_subscribe_index', [], Response::HTTP_SEE_OTHER);
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="app_subscribe_show", methods={"GET"})
     */
    public function show(Subscribe $subscribe): Response
    {
        return $this->render('subscribe/show.html.twig', [
            'subscribe' => $subscribe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_subscribe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Subscribe $subscribe, SubscribeRepository $subscribeRepository): Response
    {
        $form = $this->createForm(SubscribeType::class, $subscribe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscribeRepository->add($subscribe);
            return $this->redirectToRoute('app_subscribe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subscribe/edit.html.twig', [
            'subscribe' => $subscribe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_subscribe_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Subscribe $subscribe, SubscribeRepository $subscribeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subscribe->getId(), $request->request->get('_token'))) {
            $subscribeRepository->remove($subscribe);
        }

        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }
}
