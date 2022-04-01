<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    private $entityManager; // pour recuperer tous nos produits on a besoin orm doctrine il nous faut entity manager

    public function __construct(EntityManagerInterface $entityManager)//initialisation du constructeur
    {
        $this->entityManager = $entityManager;//mecanisme de l'injection depandence qui rentre dans ce controller on prenant entity manager 
    }


    #[Route('/nos-produits', name: 'products')]
    public function index(Request $request, PaginatorInterface $paginator )
    {

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);//appel le form avec la methodee createFom

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }else{
            $products = $this->entityManager->getRepository(Product::class)->findAll();// recuperer la repository en mettant le nom de la classe et lui demande de tout nous les chercher (findAll)
        }

        $products = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        return $this->render('product/index.html.twig', [
            'products' => $products,//passer une variable qui me permettre d'afficher tout mes produits coté twig 
            'form' => $form->createView(),
        ]);
    }
    #[Route('/produit{slug}', name: 'product')]//{slug} parametre d'url ou symfony cherche le produit depuis le sleug
    public function show($slug)//inject sleug dans la fonction
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);//on a faire une requete sql en changent la methode=>chercher un produit par son sleug
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);


        if (!$product) {
            return $this->redirectToRoute('products');// si tu ne trouve pas le produit fait une redirection vers produit 
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'products' => $products,
        ]);
    }
}