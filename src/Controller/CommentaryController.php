<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commentary")
 */
class CommentaryController extends AbstractController
{
    /**
     * @Route("/", name="app_commentary_index", methods={"GET"})
     */
    public function index(CommentaryRepository $commentaryRepository): Response
    {
        return $this->render('commentary/index.html.twig', [
            'commentaries' => $commentaryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_commentary_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommentaryRepository $commentaryRepository): Response
    {
        $commentary = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $commentary->setIdUser($user);
            // $commentary->setIdArticle($article);
            $commentaryRepository->add($commentary);
            return $this->redirectToRoute('app_commentary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentary/new.html.twig', [
            'commentary' => $commentary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_commentary_show", methods={"GET"})
     */
    public function show(Commentary $commentary): Response
    {
        return $this->render('commentary/show.html.twig', [
            'commentary' => $commentary,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_commentary_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commentary $commentary, CommentaryRepository $commentaryRepository): Response
    {
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaryRepository->add($commentary);
            return $this->redirectToRoute('app_commentary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentary/edit.html.twig', [
            'commentary' => $commentary,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_commentary_delete", methods={"POST"})
     */
    public function delete(Request $request, Commentary $commentary, CommentaryRepository $commentaryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commentary->getId(), $request->request->get('_token'))) {
            $commentaryRepository->remove($commentary);
        }

        return $this->redirectToRoute('app_commentary_index', [], Response::HTTP_SEE_OTHER);
    }
}
