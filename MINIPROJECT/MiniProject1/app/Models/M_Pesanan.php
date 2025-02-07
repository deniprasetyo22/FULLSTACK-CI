<?php

namespace App\Models;

use App\Entities\Pesanan;

class M_Pesanan
{
    private $pesananList = [];

    public function __construct()
    {
        $this->pesananList = [
            new Pesanan(1, ['Sepatu', 'Baju'], 130000, 'Pending'),
            new Pesanan(2, ['Laptop'], 10000000, 'Diproses'),
        ];
    }

    public function getAllPesanan()
    {
        return $this->pesananList;
    }

    public function getPesananById($id)
    {
        foreach ($this->pesananList as $pesanan) {
            if ($pesanan->getId() == $id) {
                return $pesanan;
            }
        }
        return null;
    }

    public function addPesanan(Pesanan $pesananList)
    {
        $this->pesananList[] = $pesananList;
    }

    public function updatePesanan($id, Pesanan $pesananList)
    {
        foreach ($this->pesananList as $index => $pesanan) {
            if ($pesanan->getId() == $id) {
                $this->pesananList[$index] = $pesananList;
                return true;
            }
        }
        return false;
    }

    public function deletePesanan($id)
    {
        foreach ($this->pesananList as $index => $pesanan) {
            if ($pesanan->getId() == $id) {
                unset($this->pesananList[$index]);
                $this->pesananList = array_values($this->pesananList); // Reset indeks array
                return true;
            }
        }
        return false;
    }
}

?>