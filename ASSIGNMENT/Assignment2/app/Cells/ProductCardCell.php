<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class ProductCardCell extends Cell
{
    protected $product;
    protected $showDiscount = false;

    public function mount($productId)
    {
        // Simulasi mengambil data produk
        $this->product = [
            'id' => $productId,
            'name' => 'Laptop Gaming',
            'price' => 15000000,
            'discount' => 10,
            // 'image' => 'laptop.jpg'
        ];
    }

    public function getProductProperty()
    {
        return $this->product;
    }

    public function getShowDiscountProperty()
    {
        return $this->showDiscount;
    }

    public function getDiscountedPrice()
    {
        if (!$this->showDiscount) {
            return $this->product['price'];
        }
        
        return $this->product['price'] * (100 - $this->product['discount']) / 100;
    }
    
    public function toggleDiscount()
    {
        $this->showDiscount = !$this->showDiscount;
    }

}