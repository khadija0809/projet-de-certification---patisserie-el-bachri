<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)//injection de dépendance (session interface)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/mon-panier', name: 'cart')]
    public function index(Cart $cart): Response
    {
        
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ] );
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id)//ajouter un produit au panier
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    #[Route("/cart/remove", name: "remove_my_cart")]
    public function remove(Cart $cart ) //vider mon panier
    {
        $cart->remove();
        return $this->redirectToRoute('products');
    }

    #[Route("/cart/remove/{id}", name: "delete_to_cart")]//supprimer un produit
    public function delete(Cart $cart, $id)
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }

    #[Route("/cart/decrease/{id}", name: "decrease_to_cart")]//demunier
    public function decrease(Cart $cart, $id)
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart');
    }




}