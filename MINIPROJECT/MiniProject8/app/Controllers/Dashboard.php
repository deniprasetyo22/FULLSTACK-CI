<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->productModel = new \App\Models\ProductModel();
        $this->categoryModel = new \App\Models\CategoryModel();
    }
    
    // public function adminDashboard()
    // {
    //     $parser = \Config\Services::parser();

    //     $data = [
    //         'page_title' => 'Admin Dashboard',
    //         'total_users' => $this->userModel->getTotalUsers(),
    //         'active_users' => count($this->userModel->findActiveUsers()),
    //         'new_users_this_month' => $this->userModel->getNewUsersThisMonth(),
    //         'total_products' => $this->productModel->countTotalProducts(),
    //         'active_products' => count($this->productModel->findActiveProducts()),
    //         'out_of_stock' => count($this->productModel->where('stock', 0)->findAll()),
    //         'on_sale' => count($this->productModel->where('is_sale', true)->findAll()),
    //         'growth_percentage' => $this->userModel->getUserStatistics()['growth_percentage']
    //     ];
    

    //     $data = [
    //         'content' => $parser->setData($data)->render('components/dashboard'), 
    //         'hideHeader' => true
    //     ];

    //     return view('pages/dashboard/v_admin_dashboard', $data,);
    // }


    /* Admin Dashboard */
    public function adminDashboard()
    {
        $productCategoryDistribution = $this->productCategoryDistribution();
        $productGrowth = $this->productGrowth();
        $topCategories = $this->topCategories();
        
        $data = [
            'page_title' => 'Admin Dashboard',
            'productCategoryDistribution' => json_encode($productCategoryDistribution),
            'productGrowth' => json_encode($productGrowth),
            'topCategories' => json_encode($topCategories),
            'hideHeader' => true
        ];

        return view('pages/dashboard/v_admin_dashboard', $data,);
    }

    /* Pie Chart */
    private function productCategoryDistribution()
    {
        $productCategoryDistribution = $this->productModel->getProductCategoryDistribution();

        $categoryName = [];
        $productCount = [];
        $colors = [];

        foreach ($productCategoryDistribution as $distribution) {
            $categoryName[] = $distribution['category_name'] . ' = ' . $distribution['percentage'] . '%';
            $productCount[] = $distribution['product_count'];
            $colors[] = $this->generateRandomColor();
        }

        return [
            'labels' => $categoryName,
            'datasets' => [
                [
                    'label' => 'Product Count',
                    'data' => $productCount,
                    'backgroundColor' => $colors,
                    'hoverOffset' => 4
                ]
            ]
        ];
    }

    private function generateRandomColor()
    {
        $r = rand(50, 255);  // Hindari terlalu gelap (50-255)
        $g = rand(50, 255);
        $b = rand(50, 255);
        return "rgb($r, $g, $b)";
    }

    /* Line Chart */
    private function productGrowth()
    {
        $productGrowth = $this->productModel->getProductGrowth();

        $labels = [];
        $productCounts = [];

        foreach ($productGrowth as $growth) {
            $labels[] = $growth['period'];  // Format YYYY-MM
            $productCounts[] = $growth['product_count'];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Product Total = ' . array_sum($productCounts),
                    'data' => $productCounts,
                    'backgroundColor' => $this->generateRandomColor(),
                    'borderColor' => $this->generateRandomColor(),
                    'borderWidth' => 2
                ]
            ]
        ];
    }

    /* Bar Chart */
    private function topCategories()
    {
        $topCategories = $this->productModel->getTopCategories();

        $labels = [];
        $productCounts = [];
        $colors = [];
        $borderColors = [];

        foreach ($topCategories as $category) {
            $labels[] = $category['category_name'];
            $productCounts[] = $category['product_count'];

            $randomColor = $this->generateRandomColor();
            $colors[] = $randomColor;
            $borderColors[] = $randomColor;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Product Total',
                    'data' => $productCounts,
                    'backgroundColor' => $colors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 2
                ]
            ]
        ];
    }

    /* Report */
    public function report()
    {
        $category = $this->categoryModel->findAll();

        $data = [
            'page_title' => 'Report',
            'category' => $category,
            'hideHeader' => true
        ];

        return view('pages/admin/report/v_report', $data);
    }


    /* Manager Dashboard */
    public function managerDashboard()
    {
        $data = [
            'page_title' => 'Manager Dashboard',
            'hideHeader' => true
        ];

        return view('pages/dashboard/v_manager_dashboard', $data);
    }
}

?>