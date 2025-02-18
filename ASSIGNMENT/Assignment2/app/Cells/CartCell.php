<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class CartCell extends Cell
{
    protected $products = [];

    public function mount()
    {
        $this->products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 1000000, 'quantity' => 1],
            ['id' => 2, 'name' => 'Keyboard', 'price' => 50000, 'quantity' => 2],
            ['id' => 3, 'name' => 'Mouse', 'price' => 30000, 'quantity' => 3],
        ];
    }

    public function getProductProperty()
    {
        return $this->products;
    }

    public function getTotalPriceProperty()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }
        return $totalPrice;
    }


}