<?php

namespace App\Entities;

class Produk
{
    private $id;
    private $nama;
    private $harga;
    private $stok;
    private $kategori;

    public function __construct($id, $nama, $harga, $stok, $kategori)
    {
        $this->setId($id);
        $this->setNama($nama);
        $this->setHarga($harga);
        $this->setStok($stok);
        $this->setKategori($kategori);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getHarga()
    {
        return $this->harga;
    }

    public function getStok()
    {
        return $this->stok;
    }

    public function getKategori()
    {
        return $this->kategori;
    }

    // Setters with validation
    public function setId($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new \InvalidArgumentException("ID harus berupa angka positif.");
        }
        $this->id = $id;
    }

    public function setNama($nama)
    {
        if (empty($nama)) {
            throw new \InvalidArgumentException("Nama produk tidak boleh kosong.");
        }
        $this->nama = $nama;
    }

    public function setHarga($harga)
    {
        if (!is_numeric($harga) || $harga < 0) {
            throw new \InvalidArgumentException("Harga harus berupa angka positif atau nol.");
        }
        $this->harga = $harga;
    }

    public function setStok($stok)
    {
        if (!is_numeric($stok) || $stok < 0) {
            throw new \InvalidArgumentException("Stok tidak boleh negatif.");
        }
        $this->stok = $stok;
    }

    public function setKategori($kategori)
    {
        if (empty($kategori)) {
            throw new \InvalidArgumentException("Kategori tidak boleh kosong.");
        }
        $this->kategori = $kategori;
    }

    // Methods to modify stock
    public function kurangiStok($jumlah)
    {
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            throw new \InvalidArgumentException("Jumlah pengurangan harus angka positif.");
        }
        if ($jumlah > $this->stok) {
            throw new \InvalidArgumentException("Stok tidak mencukupi.");
        }
        $this->stok -= $jumlah;
    }

    public function tambahStok($jumlah)
    {
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            throw new \InvalidArgumentException("Jumlah penambahan harus angka positif.");
        }
        $this->stok += $jumlah;
    }

    public function getAllInfo()
    {
        return "ID: {$this->id}, Nama: {$this->nama}, Harga: {$this->harga}, Stok: {$this->stok}, Kategori: {$this->kategori}";
    }
}