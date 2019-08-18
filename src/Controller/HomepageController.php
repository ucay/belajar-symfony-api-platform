<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage/{nama}", name="homepage")
     */
    public function index(Request $request, string $nama)
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'nama' => $nama,
            'req' => $request,
        ]);
    }
}
