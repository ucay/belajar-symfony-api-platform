<?php

namespace App\Controller;

use App\Entity\Buku;
use App\Form\BukuType;
use App\Repository\BukuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/buku")
 */
class BukuController extends AbstractController
{
    /**
     * @Route("/", name="buku_index", methods={"GET"})
     */
    public function index(BukuRepository $bukuRepository): Response
    {
        return $this->render('buku/index.html.twig', [
            'bukus' => $bukuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="buku_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $buku = new Buku();
        $form = $this->createForm(BukuType::class, $buku);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($buku);
            $entityManager->flush();

            return $this->redirectToRoute('buku_index');
        }

        return $this->render('buku/new.html.twig', [
            'buku' => $buku,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="buku_show", methods={"GET"})
     */
    public function show(Buku $buku): Response
    {
        return $this->render('buku/show.html.twig', [
            'buku' => $buku,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="buku_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Buku $buku): Response
    {
        $form = $this->createForm(BukuType::class, $buku);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('buku_index');
        }

        return $this->render('buku/edit.html.twig', [
            'buku' => $buku,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="buku_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Buku $buku): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$buku->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($buku);
            $entityManager->flush();
        }

        return $this->redirectToRoute('buku_index');
    }
}
