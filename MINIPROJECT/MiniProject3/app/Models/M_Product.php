<?php

namespace App\Models;

use App\Entities\Product;

class M_Product
{
    private $products = [];

    public function __construct()
    {
        $this->products = [
            new Product([
                'id'        => 1,
                'name'      => 'Bakso',
                'price'     => 15000,
                'stock'     => 10,
                'category'  => 'Food',
                'slug'      => 'bakso',
                'is_new'    => 'Yes',
                'is_sale'   => 'No',
                'is_active' => 'Active',
            ]),
            new Product([
                'id'        => 2,
                'name'      => 'Sate',
                'price'     => 20000,
                'stock'     => 20,
                'category'  => 'Food',
                'slug'      => 'sate',
                'is_new'    => 'No',
                'is_sale'   => 'Yes',
                'is_active' => 'Inactive',
            ]),
            new Product([
                'id'        => 3,
                'name'      => 'Mie Ayam',
                'price'     => 15000,
                'stock'     => 15,
                'category'  => 'Food',
                'slug'      => 'mie-ayam',
                'is_new'    => 'Yes',
                'is_sale'   => 'No',
                'is_active' => 'Active',
            ]),
            new Product([
                'id'        => 4,
                'name'      => 'Ice Tea',
                'price'     => 5000,
                'stock'     => 8,
                'category'  => 'Beverage',
                'slug'      => 'ice-tea',
                'is_new'    => 'No',
                'is_sale'   => 'Yes',
                'is_active' => 'Inactive',
            ]),
            new Product([
                'id'        => 5,
                'name'      => 'Lemon Tea',
                'price'     => 10000,
                'stock'     => 12,
                'category'  => 'Beverage',
                'slug'      => 'lemon-tea',
                'is_new'    => 'Yes',
                'is_sale'   => 'No',
                'is_active' => 'Active',
            ]),
            new Product([
                'id'        => 6,
                'name'      => 'Coffee',
                'price'     => 15000,
                'stock'     => 18,
                'category'  => 'Beverage',
                'slug'      => 'coffee',
                'is_new'    => 'No',
                'is_sale'   => 'Yes',
                'is_active' => 'Active',
            ]),
        ];
    }

    public function getAllProduct()
    {
        return $this->products;
    }

    public function getProductById($id)
    {
        foreach ($this->products as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        return null;
    }

    public function getProductBySlug($slug)
    {
        foreach ($this->products as $item) {
            if ($item->getSlug() == $slug) {
                return $item;
            }
        }
        return null;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function updateProduct($slug, Product $product)
    {
        foreach ($this->products as $index => $p) {
            if ($p->getSlug() == $slug) {
                $this->products[$index] = $product;
                return true;
            }
        }
        return false;
    }

    public function deleteProduct($slug)
    {
        foreach ($this->products as $index => $p) {
            if ($p->getSlug() == $slug) {
                unset($this->products[$index]);
                return true;
            }
        }
        return false;
    }
}

?>