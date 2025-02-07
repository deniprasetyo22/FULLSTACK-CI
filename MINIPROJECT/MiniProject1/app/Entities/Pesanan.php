<?php

namespace App\Entities;

class Pesanan
{
    private $id;
    private $produk;
    private $total;
    private $status;

    public function __construct($id, $produk, $total, $status)
    {
        $this->setId($id);
        $this->setProduk($produk);
        $this->setTotal($total);
        $this->setStatus($status);
    }

    // Getter dan Setter dengan Validasi
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new \InvalidArgumentException("ID harus berupa angka positif.");
        }
        $this->id = $id;
    }

    public function getProduk()
    {
        return $this->produk;
    }

    public function setProduk($produk)
    {
        if (empty($produk)) {
            throw new \InvalidArgumentException("Produk tidak boleh kosong.");
        }
        $this->produk = $produk;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        if (!is_numeric($total) || $total < 0) {
            throw new \InvalidArgumentException("Total harus angka positif atau nol.");
        }
        $this->total = $total;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Method tambahan untuk info lengkap
    public function getFullInfo()
    {
        return "ID: {$this->id}, Produk: {$this->produk}, Total: {$this->total}, Status: {$this->status}";
    }
}

?>