<?php

namespace App\Controllers;

use App\Libraries\DataParams;
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
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_products'),
            'perPage' => $this->request->getGet('perPage'),
            'category' => $this->request->getGet('category'),
            'price' => $this->request->getGet('price'),
        ]);

        $results = $this->productModel->getFilteredProductsForPublic($params);

        $data = [
            'page_title' => 'Product List',
            'products' => $results['products'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'category' => $this->productModel->getAllCategories(),
            'price' => $this->productModel->getRangePrice(),
            'baseUrl' => base_url('/'),
        ];
        
        return view('pages/public/product/v_index', $data);
    }

    public function indexAdmin()
    {
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_products'),
            'perPage' => $this->request->getGet('perPage'),
            'category' => $this->request->getGet('category'),
            'price' => $this->request->getGet('price'),
        ]);

        $results = $this->productModel->getFilteredProducts($params);

        $data = [
            'page_title' => 'Product List',
            'products' => $results['products'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'category' => $this->productModel->getAllCategories(),
            'price' => $this->productModel->getRangePrice(),
            'baseUrl' => base_url('product'),
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
}