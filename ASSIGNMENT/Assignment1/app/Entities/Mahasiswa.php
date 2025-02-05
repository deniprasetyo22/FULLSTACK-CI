<?php 
namespace App\Entities;

class Mahasiswa{
    private $nim;
    private $nama;
    private $jurusan;

    public function __construct($nim, $nama, $jurusan)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->jurusan = $jurusan;
    }

    public function getNIM()
    {
        return $this->nim;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getJurusan()
    {
        return $this->jurusan;
    }

    public function getFullInfo()
    {
        return "NIM : {$this->nim}, Nama : {$this->nama}, Jurusan : {$this->jurusan}";
    }
}
?>