<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Article;
use CodeIgniter\HTTP\ResponseInterface;

class Article extends BaseController
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new M_Article();
    }

    public function index()
    {
        $data['articles'] = $this->articleModel->getAllArticles();
        return view('/article/index', $data);
    }
}