<?php 
namespace App\Entities;

class Mahasiswa{
    private $nim;
    private $nama;
    private $jurusan;

    public function __construct($nim, $nama, $jurusan)
    {
        $this->setNIM($nim);
        $this->setNama($nama);
        $this->setJurusan($jurusan);
    }

    public function getNIM()
    {
        return $this->nim;
    }

    public function setNIM($nim)
    {
        if (empty($nim)) {
            throw new \InvalidArgumentException("NIM tidak boleh kosong.");
        }
        $this->nim = $nim;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        if (empty($nama)) {
            throw new \InvalidArgumentException("Nama tidak boleh kosong.");
        }
        $this->nama = $nama;
    }

    public function getJurusan()
    {
        return $this->jurusan;
    }

    public function setJurusan($jurusan)
    {
        if (empty($jurusan)) {
            throw new \InvalidArgumentException("Jurusan tidak boleh kosong.");
        }
        $this->jurusan = $jurusan;
    }

    public function getFullInfo()
    {
        return "NIM : {$this->nim}, Nama : {$this->nama}, Jurusan : {$this->jurusan}";
    }
}