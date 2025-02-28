<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $userModel;
    protected $productModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->productModel = new \App\Models\ProductModel();
    }
    
    public function dashboard()
    {
        $parser = \Config\Services::parser();

        $data = [
            'page_title' => 'Dashboard',
            'total_users' => $this->userModel->getTotalUsers(),
            'active_users' => count($this->userModel->findActiveUsers()),
            'new_users_this_month' => $this->userModel->getNewUsersThisMonth(),
            'total_products' => $this->productModel->countTotalProducts(),
            'active_products' => count($this->productModel->findActiveProducts()),
            'out_of_stock' => count($this->productModel->where('stock', 0)->findAll()),
            'on_sale' => count($this->productModel->where('is_sale', 1)->findAll()),
            'growth_percentage' => $this->userModel->getUserStatistics()['growth_percentage']
        ];
    

        $data = [
            'content' => $parser->setData($data)->render('components/dashboard'), 
            'hideHeader' => true
        ];

        return view('pages/admin/v_dashboard', $data, ['cache' => 1, 'cache_name' => 'dashboard_admin']);
    }
}

?>