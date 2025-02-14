<?php

namespace App\Controllers;
use App\Models\M_Article;

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
        return view('articles/index', $data);
    }

    public function show($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('articles/show', ['article' => $article]);
    }


    public function create()
    {
        return view('articles/create');
    }

    public function store()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $articles = new \App\Entities\Article($data);
            $this->articleModel->createArticle($articles);
            $data['articles'] = $this->articleModel->getAllArticles();
        }

        // return redirect()->to('/articles')->with('message', 'Article created successfully.');
        return view('articles/index', $data);
    }

    public function edit($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('articles/edit', ['article' => $article]);
    }

    public function update($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $this->articleModel->updateArticle($slug, $data);
            $data['articles'] = $this->articleModel->getAllArticles();
        }

        // return redirect()->to('/articles')->with('message', 'Article updated successfully.');
        return view('articles/index', $data);
    }

    public function delete($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->articleModel->deleteArticle($slug)) {
            $data['articles'] = $this->articleModel->getAllArticles();
            return view('articles/index', $data);
            // return redirect()->to('/articles')->with('message', 'Article deleted successfully.');
        }

        return redirect()->to('/articles')->with('error', 'Failed to delete article.');

    }
}