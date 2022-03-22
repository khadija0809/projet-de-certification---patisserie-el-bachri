<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Requête qui me permet de recupperer les produits en fonction de la recherche de l'utilisateur
     *  @return Product[]
     */

    public function findWithSearch (Search $search)
    {
        $query = $this // on ouvr une variable qui s'appelle query et va mettre dedand pulsieurs method
        ->createQueryBuilder('p') // on commence de créé un query et on fait la maping avec la table product representé par 'p'
        -> select('c', 'p') // on a besoin dans cette query de selectionner 'c' category et 'p' product
        ->join('p.category', 'c');// et on a besoin qu nous face une jointure entre les catégorie de mon produit et la table category 

        if (!empty($search->categories)) { // on dit a notre repository c'est tu n'est pas vide je veux
            $query = $query // que tu me prenne query
            ->andWhere('c.id IN (:categories)') // et dedans tu me rajoute un andWhere ou j 
            // besoin que les Id de mes category soit dans la liste categories que je t'envoie en parametre dans mon objet search
            ->setParameter('categories', $search->categories);// je te donne ce parametre qui le nom category et sa valeur ce qu'il ya dans dans search categories
        }
        if (!empty($search->string)) {// si une recherche textuelle realisé avec notre utilisateur 
            $query = $query
            ->andWhere('p.name LIke :string')// est ce que sa ressemble a la recherche
            ->setParameter('string', "%{$search->string}%");// le sting que ja passe au param equivaut search strin
        }

        return $query->getQuery()->getResult();// retourn moi la query qui tu execute
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
