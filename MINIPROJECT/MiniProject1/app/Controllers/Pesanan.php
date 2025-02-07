<?php

namespace App\Controllers;

use App\Models\M_Pesanan;
use App\Entities\Pesanan as PesananEntity;

class Pesanan extends BaseController
{
    private $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new M_Pesanan();
    }

    public function index()
    {
        $data['pesanan'] = $this->pesananModel->getAllPesanan();
        return view('pesanan/index', $data);
    }

    public function detail($id)
    {
        $data['pesanan'] = $this->pesananModel->getPesananById($id);   
        if (empty($data['pesanan'])){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('pesanan/detail', $data);
    }

    public function create()
    {
        $produkModel = new \App\Models\M_Produk();
        $products = $produkModel->getAllProduk();

        return view('pesanan/create', ['products' => $products]);
    }


    public function store()
    {
        $id = $this->request->getPost('id');
        $produk = $this->request->getPost('produk');
        $total = $this->request->getPost('total');
        $status = 'Pending';
        
        if (is_array($produk)) {
            $produk = implode(', ', $produk);
        }
        
        $pesanan = new PesananEntity($id, $produk, $total, $status);
        $this->pesananModel->addPesanan($pesanan);
        
        // return redirect()->to('/pesanan')->with('success', 'Pesanan berhasil ditambahkan.');
        $data['pesanan'] = $this->pesananModel->getAllPesanan();
        return view('pesanan/index', $data);
    }

    public function edit($id)
    {
        $data['pesanan'] = $this->pesananModel->getPesananById($id);
        if (empty($data['pesanan'])){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $produkModel = new \App\Models\M_Produk();
        $data['products'] = $produkModel->getAllProduk();
        return view('pesanan/edit', $data);
    }

    public function update($id)
    {
        $id = $this->request->getPost('id');
        $produk = $this->request->getPost('produk');
        $total = $this->request->getPost('total');
        $status = $this->request->getPost('status');

        $pesanan = new PesananEntity($id, $produk, $total, $status);
        $this->pesananModel->updatePesanan($id, $pesanan);

        // return redirect()->to('/pesanan')->with('success', 'Pesanan berhasil diperbarui.');
        $data['pesanan'] = $this->pesananModel->getAllPesanan();
        return view('pesanan/index', $data);
    }

    public function delete($id)
    {
        if ($this->pesananModel->deletePesanan($id)) {
            // return redirect()->to('/pesanan')->with('success', 'Pesanan berhasil dihapus.');
            $data['pesanan'] = $this->pesananModel->getAllPesanan();
            return view('pesanan/index', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}

?>