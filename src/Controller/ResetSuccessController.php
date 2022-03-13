<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetSuccessController extends AbstractController
{
    #[Route('/reset/success', name: 'reset_success')]
    public function index(): Response
    {
        return $this->render('reset_success/index.html.twig', [
            'controller_name' => 'ResetSuccessController',
        ]);
    }
}
