<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionsGeneralesDeVenteController extends AbstractController
{
    #[Route('/cgv', name: 'conditions_generales_de_vente')]
    public function index(): Response
    {
        return $this->render('conditions_generales_de_vente/index.html.twig', [
            'controller_name' => 'ConditionsGeneralesDeVenteController',
        ]);
    }
}
