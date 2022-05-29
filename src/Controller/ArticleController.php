<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\CryptoCurrency;
use App\Form\ArticleType;
use App\Form\CommentaryType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("{_locale}/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id_crypto}", name="app_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository, $id_crypto): Response
    {
        // GESTION DES DROITS
        $user = $this->getUser();
        try {
            $this->denyAccessUnlessGranted('ROLE_EXPERT');
        } catch (\Throwable $th) {
            //throw $th;
            if (!$user) {
                return $this->redirectToRoute('app_login');
            } else {
                return $this->redirectToRoute('app_accueil');
            }
        }

        // ON RECUPERE LA CRYPTO
        // (normalement il y a un moyen plus simple de le faire mais j'y arrive pas...)
        $crypto = $this->getDoctrine()->getRepository(CryptoCurrency::class)->findOneBy(['id' => $id_crypto]);
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $article->setIdUser($user);
            $article->setIdCrypto($crypto);
            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_article_show", methods={"GET", "POST"})
     */
    public function show(Article $article, Request $request, CommentaryRepository $commentaryRepository): Response
    {
        // GESTION DES DROITS
        $user = $this->getUser();
        try {
            $this->denyAccessUnlessGranted('ROLE_MEMBRE');
        } catch (\Throwable $th) {
            //throw $th;
            if (!$user) {
                return $this->redirectToRoute('app_login');
            } else {
                return $this->redirectToRoute('app_accueil');
            }
        }

        // AJOUT DES COMMENTAIRES DIRECTEMENT AVEC L'ARTICLE
        $commentary = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentary->setIdArticle($article);
            $commentary->setIdUser($user);

            $commentaryRepository->add($commentary);
            return $this->redirectToRoute('app_article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EXPERT');

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->add($article);
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EXPERT');

        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $articleRepository->remove($article);
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
