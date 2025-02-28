<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->getProductsWithCategoryAndImage()->findAll();
        
        $data = [
            'page_title' => 'Product List',
            'products' => $products,
        ];
        
        return view('pages/public/product/v_index', $data);
    }

    public function indexAdmin()
    {
        $products = $this->productModel->getProductsWithCategoryAndImage()->findAll();
        
        $data = [
            'page_title' => 'Product List',
            'products' => $products,
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_index', $data);
    }

    public function create()
    {
        $categoryList = array_map(fn($category) => $category->toArray(), $this->categoryModel->findAll());

        $data = [
            'page_title' => 'Create Product',
            'categoryList' => $categoryList,
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_create', $data);
    }

    public function store()
    {
        $productData = $this->request->getPost();

        $productData['status'] = 'Active';
        $productData['is_new'] = true;
        $productData['is_sale'] = true;

        $product = new \App\Entities\Product($productData);
        
        $rules = $this->productModel->getValidationRules();
        $messages = $this->productModel->getValidationMessages();
        
        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->save($product);
        
        return redirect()->to(base_url('product'))->with('message', 'Product Added Successfully.');

    }

    public function show($id)
    {
        $product = $this->productModel->getProductsWithCategoryAndImage()->find($id);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'page_title' => 'Product Detail',
            'product' => $product,
            'hideHeader' => true
        ];
        return view('pages/admin/product/v_detail', $data);
    }

    public function edit($id)
    {
        $product = $this->productModel->getProductsWithCategoryAndImage()->find($id);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $categoryList = array_map(fn($category) => $category->toArray(), $this->categoryModel->findAll());
        
        $data = [
            'page_title' => 'Edit Product',
            'product' => $product,
            'categoryList' => $categoryList,
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_edit', $data);
    }

    public function update($id)
    {
        $product = new \App\Entities\Product($this->request->getPost());
        
        $rules = $this->productModel->getValidationRules();
        $messages = $this->productModel->getValidationMessages();
        
        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->update($id, $product);
        
        return redirect()->to(base_url('product'))->with('message', 'Product Updated Successfully.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $this->productModel->delete($id);
        return redirect()->to(base_url('product'))->with('message', 'Product Deleted Successfully.');
    }

    // public function productListForUser()
    // {
    //     $parser = \Config\Services::parser();

    //     $products = $this->productModel->getAllProduct();

    //     // Konversi objek Product ke array
    //     $productArray = array_map(function ($product) {
    //         return [
    //             'id'         => $product->getId(),
    //             'name'       => $product->getName(),
    //             'price'      => number_format($product->getPrice(), 0, ',', '.'),
    //             'stock'      => $product->getStock(),
    //             'category'   => $product->getCategory(),
    //             'slug'       => $product->getSlug(),
    //             'is_active'  => $product->getIsActive() ? 'Active' : 'Inactive',
    //             'is_new'     => $product->getIsNew() ? 'Yes' : 'No',
    //             'is_sale'    => $product->getIsSale() ? 'Yes' : 'No',
    //             'url_detail' => url_to('product-detail', $product->getSlug()),
    //         ];
    //     }, $products);

    //     $data = [
    //         'products' => $productArray,
    //         'product_statistics_cell' => view_cell('ProductStatisticsCell', 'limit=3', HOUR, 'product_statistics_cell'),
    //     ];
        

    //     $data['content'] = $parser->setData($data)->render('components/product_list');

    //     return view('pages/public/product/v_product_list', $data, ['cache' => HOUR, 'cache_name' => 'product_list']);
    // }

    // public function productDetailForUser($slug)
    // {
    //     $parser = \Config\Services::parser();

    //     $product = $this->productModel->getProductBySlug($slug);

    //     if ($product == null) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
        
    //     $data = [
    //         'id'       => $product->getId(),
    //         'name'     => $product->getName(),
    //         'price'    => number_format($product->getPrice(), 0, ',', '.'),
    //         'stock'    => $product->getStock(),
    //         'category' => $product->getCategory(),
    //         'slug'     => $product->getSlug(),
    //     ];

    //     $data['content'] = $parser->setData($data)->render('components/product_detail');

    //     return view('pages/public/product/v_product_detail', $data);
    // }
}