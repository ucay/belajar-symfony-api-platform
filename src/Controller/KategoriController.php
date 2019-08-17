<?php

namespace App\Controller;

use App\Entity\Kategori;
use App\Form\KategoriType;
use App\Repository\KategoriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kategori")
 */
class KategoriController extends AbstractController
{
    /**
     * @Route("/", name="kategori_index", methods={"GET"})
     */
    public function index(KategoriRepository $kategoriRepository): Response
    {
        return $this->render('kategori/index.html.twig', [
            'kategoris' => $kategoriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kategori_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kategori = new Kategori();
        $form = $this->createForm(KategoriType::class, $kategori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kategori);
            $entityManager->flush();

            return $this->redirectToRoute('kategori_index');
        }

        return $this->render('kategori/new.html.twig', [
            'kategori' => $kategori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kategori_show", methods={"GET"})
     */
    public function show(Kategori $kategori): Response
    {
        return $this->render('kategori/show.html.twig', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kategori_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kategori $kategori): Response
    {
        $form = $this->createForm(KategoriType::class, $kategori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kategori_index');
        }

        return $this->render('kategori/edit.html.twig', [
            'kategori' => $kategori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kategori_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kategori $kategori): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kategori->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kategori);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kategori_index');
    }
}
