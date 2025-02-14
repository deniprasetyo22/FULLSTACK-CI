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

    // GET /produk
    public function index()
    {
        $data['produk'] = $this->produkModel->getAllProduk();
        return view('produk/v_index', $data);
    }

    // GET /produk/new
    public function new()
    {
        $kategoriList = ['Makanan', 'Minuman', 'Elektronik', 'Fashion'];
        return view('produk/v_create', ['kategoriList' => $kategoriList]);
    }

    // POST /produk
    public function create()
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
        return view('produk/v_index', $data);
    }

    // GET /produk/(:segment)
    public function show($id)
    {
        $data['produk'] = $this->produkModel->getProdukById($id);
        if ($data['produk'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('produk/v_detail', $data);
    }

    // GET /produk/(:segment)/edit
    public function edit($id)
    {
        $data['produk'] = $this->produkModel->getProdukById($id);
        if ($data['produk'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('produk/v_edit', $data);
    }

    // PUT /produk/(:segment)
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
        return view('produk/v_index', $data);
    }

    // DELETE /produk/(:segment)
    public function delete($id)
    {
        if ($this->produkModel->deleteProduk($id)) {
            // return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
            $data['produk'] = $this->produkModel->getAllProduk();
            return view('produk/v_index', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // POST /produk/updateStock/(:segment)/(:any)
    // public function updateStock($id, $action)
    // {
    //     $produk = $this->produkModel->getProdukById($id);
    //     if (!$produk) {
    //         return $this->response->setJSON(['success' => false]);
    //     }

    //     if ($action === 'increase') {
    //         $produk->stok += 1;
    //     } elseif ($action === 'decrease' && $produk->stok > 0) {
    //         $produk->stok -= 1;
    //     }

    //     $this->produkModel->updateProduk($id, $produk);

    //     return $this->response->setJSON([
    //         'success' => true,
    //         'newStock' => $produk->stok
    //     ]);
    // }
}