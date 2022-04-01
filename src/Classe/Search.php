<?php

namespace App\Classe;

use App\Entity\Category;
// créer des entités en fonction de ce qu'on veut présenter a notre utilisateur
class Search
{
    /**
     * @var String
     */
    public $string = '';

    /**
     * @var Category[]
     */
    public $categories = [];
}   