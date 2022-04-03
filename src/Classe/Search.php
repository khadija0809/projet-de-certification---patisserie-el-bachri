<?php

namespace App\Classe;

use App\Entity\Category;
// classe search represente mon objet de recherche la recherche effectué par mon utilisateur 
class Search
{
    /**
     * @var String 
     * pour la recherche textuelle
     */
    public $string = '';

    /**
     * @var Category[]
     */
    public $categories = [];
}   