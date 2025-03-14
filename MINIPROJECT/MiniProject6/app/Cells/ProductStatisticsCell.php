<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class ProductStatisticsCell extends Cell
{
    protected $limit = 5;
    private $topSales = [];

    public function mount()
    {
        // Data penjualan langsung di sini
        $this->topSales = array_slice([
            ['product_name' => 'Bakso', 'total_sold' => 150],
            ['product_name' => 'Mie Ayam', 'total_sold' => 120],
            ['product_name' => 'Lemon Tea', 'total_sold' => 100],
            ['product_name' => 'Es Teh', 'total_sold' => 90],
            ['product_name' => 'Nasi Goreng', 'total_sold' => 80],
        ], 0, $this->limit);
    }

    public function getTopSalesProperty()
    {
        return $this->topSales;
    }

    public function getLimitProperty()
    {
        return $this->limit;
    }
}