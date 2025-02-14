<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('v_home');
    }

    public function about()
    {
        return view('v_about');
    }

}