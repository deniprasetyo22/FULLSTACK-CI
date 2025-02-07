<?php

namespace App\Controllers;

use App\Models\M_Produk;
use App\Entities\Produk as ProdukEntity;

class Produk extends BaseController
{
    private $produkModel;

    public function __construct()
    {
        $this->produkModel = new M_Produk();
    }

    public function index()
    {
        $data['produk'] = $this->produkModel->getAllProduk();
        return view('produk/index', $data);
    }

    public function detail($id)
    {
        $data['produk'] = $this->produkModel->getProdukById($id);
        if ($data['produk'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('produk/detail', $data);
    }

    public function create()
    {
        $kategoriList = ['Makanan', 'Minuman', 'Elektronik', 'Fashion'];
        return view('produk/create', ['kategoriList' => $kategoriList]);
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $stok = $this->request->getPost('stok');
        $kategori = $this->request->getPost('kategori');

        $produk = new ProdukEntity($id, $nama, $harga, $stok, $kategori);
        $this->produkModel->addProduk($produk);
        // return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
        $data['produk'] = $this->produkModel->getAllProduk();
        return view('produk/index', $data);
    }

    public function edit($id)
    {
        $data['produk'] = $this->produkModel->getProdukById($id);
        if ($data['produk'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('produk/edit', $data);
    }

    public function update($id)
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $stok = $this->request->getPost('stok');
        $kategori = $this->request->getPost('kategori');

        $produk = new ProdukEntity($id, $nama, $harga, $stok, $kategori);
        $this->produkModel->updateProduk($id, $produk);
        // return redirect()->to('/produk')->with('success', 'Produk berhasil diperbarui.');

        $data['produk'] = $this->produkModel->getAllProduk();
        return view('produk/index', $data);
    }

    public function delete($id)
    {
        if ($this->produkModel->deleteProduk($id)) {
            // return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
            $data['produk'] = $this->produkModel->getAllProduk();
            return view('produk/index', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
}

?>