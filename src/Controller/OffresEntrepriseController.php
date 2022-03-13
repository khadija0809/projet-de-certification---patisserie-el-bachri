<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffresEntrepriseController extends AbstractController
{
    #[Route('/offres/entreprise', name: 'offres_entreprise')]
    public function index(): Response
    {
        return $this->render('offres_entreprise/index.html.twig', [
            'controller_name' => 'OffresEntrepriseController',
        ]);
    }
}
