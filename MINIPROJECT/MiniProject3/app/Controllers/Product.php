<?php

namespace App\Controllers;

use App\Models\M_Product;
use App\Entities\Product as ProductEntity;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new M_Product();
    }

    // GET /produk
    public function index()
    {
        $data['products'] = $this->productModel->getAllProduct();
        $data['hideHeader'] = true;
        return view('pages/admin/product/v_index', $data);
    }

    // GET /produk/new
    public function create()
    {
        $categoryList = ['Food', 'Beverage'];
        $data['categoryList'] = $categoryList;
        $data['hideHeader'] = true;
        return view('pages/admin/product/v_create', $data);
    }

    // POST /produk
    public function store()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category' => $this->request->getPost('category'),
            'slug' => $this->request->getPost('slug'),
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category' => 'required',
            'slug' => 'required',
        ]);

        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $products = new ProductEntity($data);
            $this->productModel->addProduct($products);
            $data['products'] = $this->productModel->getAllProduct();
            $data['hideHeader'] = true;
        }

        return view('pages/admin/product/v_index', $data);
    }

    // GET /produk/(:segment)
    public function show($slug)
    {
        $data['product'] = $this->productModel->getProductBySlug($slug);
        if ($data['product'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['hideHeader'] = true;
        return view('pages/admin/product/v_detail', $data);
    }

    // GET /produk/(:segment)/edit
    public function edit($slug)
    {
        $data['product'] = $this->productModel->getProductBySlug($slug);
        if ($data['product'] == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['hideHeader'] = true;
        return view('pages/admin/product/v_edit', $data);
    }

    // PUT /produk/(:segment)
    public function update($slug)
    {
        $product = $this->productModel->getProductBySlug($slug);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'category' => $this->request->getPost('category'),
            'slug' => $this->request->getPost('slug'),
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category' => 'required',
            'slug' => 'required',
        ]);

        if (!$validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $products = new ProductEntity($data);
            $this->productModel->updateProduct($slug, $products);
            $data['products'] = $this->productModel->getAllProduct();
            $data['hideHeader'] = true;
        }

        return view('pages/admin/product/v_index', $data);
    }

    // DELETE /produk/(:segment)
    public function delete($slug)
    {
        $product = $this->productModel->getProductBySlug($slug);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if($this->productModel->deleteProduct($slug)) {
            $data['products'] = $this->productModel->getAllProduct();
            $data['hideHeader'] = true;
            return view('pages/admin/product/v_index', $data);
        }

        return redirect()->back()->with('error', 'Product gagal dihapus.');
    }

    public function productListForUser()
    {
        $parser = \Config\Services::parser();

        $products = $this->productModel->getAllProduct();

        // Konversi objek Product ke array
        $productArray = array_map(function ($product) {
            return [
                'id'         => $product->getId(),
                'name'       => $product->getName(),
                'price'      => number_format($product->getPrice(), 0, ',', '.'),
                'stock'      => $product->getStock(),
                'category'   => $product->getCategory(),
                'slug'       => $product->getSlug(),
                'is_active'  => $product->getIsActive() ? 'Active' : 'Inactive',
                'is_new'     => $product->getIsNew() ? 'Yes' : 'No',
                'is_sale'    => $product->getIsSale() ? 'Yes' : 'No',
                'url_detail' => url_to('product-detail', $product->getSlug()),
            ];
        }, $products);

        $data = [
            'products' => $productArray,
            'product_statistics_cell' => view_cell('ProductStatisticsCell', 'limit=3', HOUR, 'product_statistics_cell'),
        ];
        

        $data['content'] = $parser->setData($data)->render('components/product_list');

        return view('pages/public/product/v_product_list', $data, ['cache' => HOUR, 'cache_name' => 'product_list']);
    }

    public function productDetailForUser($slug)
    {
        $parser = \Config\Services::parser();

        $product = $this->productModel->getProductBySlug($slug);

        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'id'       => $product->getId(),
            'name'     => $product->getName(),
            'price'    => number_format($product->getPrice(), 0, ',', '.'),
            'stock'    => $product->getStock(),
            'category' => $product->getCategory(),
            'slug'     => $product->getSlug(),
        ];

        $data['content'] = $parser->setData($data)->render('components/product_detail');

        return view('pages/public/product/v_product_detail', $data);
    }
}