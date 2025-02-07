<?php

namespace App\Models;

use App\Entities\Produk;

class M_Produk
{
    private $produk = [];

    public function __construct()
    {
        $this->produk = [
            new Produk(1, 'Laptop', 10000000, 10, 'Elektronik'),
            new Produk(2, 'Handphone', 6000000, 5, 'Elektronik'),
            new Produk(3, 'TV', 3000000, 8, 'Elektronik'),
            new Produk(4, 'Baju', 50000, 20, 'Fashion'),
            new Produk(5, 'Celana', 40000, 15, 'Fashion'),
            new Produk(6, 'Sepatu', 80000, 12, 'Fashion'),
        ];
    }

    public function getAllProduk()
    {
        return $this->produk;
    }

    public function getProdukById($id)
    {
        foreach ($this->produk as $p) {
            if ($p->getId() == $id) {
                return $p;
            }
        }
        return null;
    }

    public function addProduk(Produk $produk)
    {
        $this->produk[] = $produk;
    }

    public function updateProduk($id, Produk $produk)
    {
        foreach ($this->produk as $index => $p) {
            if ($p->getId() == $id) {
                $this->produk[$index] = $produk;
                return true;
            }
        }
        return false;
    }

    public function deleteProduk($id)
    {
        foreach ($this->produk as $index => $p) {
            if ($p->getId() == $id) {
                unset($this->produk[$index]);
                return true;
            }
        }
        return false;
    }
}

?>