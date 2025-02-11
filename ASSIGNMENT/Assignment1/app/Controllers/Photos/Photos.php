<?php

namespace App\Controllers\Photos;

use CodeIgniter\RESTful\ResourceController;

class Photos extends ResourceController
{
    public function index()
    {
        echo "Ini Halaman Index";
    }

    public function new()
    {
        echo "Ini Halaman New";
    }

    public function create()
    {
        echo "Ini Halaman Create";
    }

    public function show($id = null)
    {
        echo "Ini Halaman Show $id";
    }

    public function edit($id = null)
    {
        echo "Ini Halaman Edit $id";
    }

}

?>