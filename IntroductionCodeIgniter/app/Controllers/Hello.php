<?php
namespace App\Controllers;

use App\Models\Hello_model;

class Hello extends BaseController
{
    public function index()
    {
        echo('Hello world');
    }

    public function hello_model()
    {
        $helloModel = new Hello_model();
        $data = $helloModel->hello();
        echo($data);
    }

    public function hello_view()
    {
        return view('hello_view');
    }

    public function hello_mvc()
    {
        $helloModel = new Hello_model();
        $data = $helloModel->hello();

        // Kirim data ke view 
        return view('hellomvc_view', [
            'message' => $data
        ]);       
    }

}