<?php

namespace App\Controllers\API;

use App\Models\M_Produk;
use CodeIgniter\RESTful\ResourceController;

class ProdukAPI extends ResourceController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new M_Produk();
    }

    public function index()
    {
        return view('api/v_index');
    }

    public function getAllProduk()
    {
        $products = $this->productModel->getAllProduk();

        // Ubah objek User menjadi array
        $data = array_map(function($products) {
            return [
                'id'       => $products->getId(),
                'nama'     => $products->getNama(),
                'harga'    => $products->getHarga(),
                'stok'     => $products->getStok(),
                'kategori' => $products->getKategori(),
            ];
        }, $products);

        // Response JSON
        return $this->response->setJSON([
            'status'  => 200,
            'message' => 'All Products',
            'data'    => $data
        ]);
    }

    public function getProdukById()
    {
        $id = $this->request->getGet('id');
        // Ambil produk berdasarkan ID
        $produk = $this->productModel->getProdukById($id);

        // Jika produk tidak ditemukan
        if (!$produk) {
            return $this->response->setJSON([
                'status'  => 404,
                'message' => 'User not found'
            ]);
        }

        // Ubah objek produk menjadi array
        $data = [
            'id'       => $produk->getId(),
            'nama'     => $produk->getNama(),
            'harga'    => $produk->getHarga(),
            'stok'     => $produk->getStok(),
            'kategori' => $produk->getKategori(),
        ];

        // Response JSON
        return $this->response->setJSON([
            'status'  => 200,
            'message' => 'Produk Details',
            'data'    => $data
        ]);
    }
    


}

?>