<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class SidebarCell extends Cell
{
    protected $menu = [];
    
    public function mount()
    {
        // Data yang akan ditampilkan di sidebar
        $this->menu = [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Produk', 'url' => '/products'],
            ['title' => 'Pesanan', 'url' => '/orders'],
            ['title' => 'Pengaturan', 'url' => '/settings']
        ];
    }

    public function getMenuProperty()
    {
        return $this->menu;
    }
    
    public function getActiveMenu()
    {
        // Mendapatkan URL saat ini
        $currentUrl = current_url();
        return $currentUrl;
    }

}