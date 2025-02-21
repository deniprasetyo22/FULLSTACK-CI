<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function dashboard()
    {
        $parser = \Config\Services::parser();

        $data = [
            'total_users' => 20,
            'total_products' => 10,
            'new_orders' => 5,
            'monthly_growth_percentage' => 10
        ];

        $data['content'] = $parser->setData($data)->render('components/dashboard');
        $data['hideHeader'] = true;

        return view('pages/admin/v_dashboard', $data, ['cache' => 1, 'cache_name' => 'dashboard_admin']);
    }
}

?>