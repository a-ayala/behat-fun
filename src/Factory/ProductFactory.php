<?php

namespace App\Factory;

use App\Entity\Product;

class ProductFactory
{
    public function create(string $title = 'default', int $price = 0): Product
    {
        $product = new Product();
        $product->setTitle($title);
        $product->setPrice($price);

        return $product;
    }
}