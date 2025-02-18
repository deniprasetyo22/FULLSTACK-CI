<?php

namespace App\Controllers;
use App\Models\M_Article;

class Article extends BaseController
{
    private $articleModel;
    protected $renderer; //template engine renderer

    public function __construct()
    {
        $this->articleModel = new M_Article();
        $this->renderer = service('renderer'); //template engine renderer
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Article List',
            'articles' => $this->articleModel->getAllArticles()
        ];
        // return view('pages/articles/index', $data, ['cache' => 60, 'cache_name' => 'articles_index']);
        return view('pages/articles/index', $data);
    }

    public function show($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pages/articles/show', ['article' => $article]);
    }


    public function create()
    {
        return view('pages/articles/create');
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
        return view('pages/articles/index', $data);
    }

    public function edit($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pages/articles/edit', ['article' => $article]);
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
        return view('pages/articles/index', $data);
    }

    public function delete($slug)
    {
        $article = $this->articleModel->getArticleBySlug($slug);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->articleModel->deleteArticle($slug)) {
            $data['articles'] = $this->articleModel->getAllArticles();
            return view('pages/articles/index', $data);
            // return redirect()->to('/articles')->with('message', 'Article deleted successfully.');
        }

        return redirect()->to('pages/articles')->with('error', 'Failed to delete article.');
    }

    public function table()
    {
        // $table = new \CodeIgniter\View\Table();
        
        // // Data yang akan ditampilkan
        // $data = [
        //     ['Nama' => 'John Doe', 'Usia' => 25, 'Pekerjaan' => 'Programmer'],
        //     ['Nama' => 'Jane Smith', 'Usia' => 28, 'Pekerjaan' => 'Designer'],
        //     ['Nama' => 'Mike Johnson', 'Usia' => 32, 'Pekerjaan' => 'Manager']
        // ];

        // // Generate tabel dengan data
        // $data['table'] = $table->generate($data);

        // // Kirim table ke view
        // return view('articles/table', $data);


        /* Menggunakan Renderer Template Engine */
        // // Contoh penggunaan setVar
        // $this->renderer->setVar('title', 'About Us');
        // $this->renderer->setVar('content', 'Ini adalah halaman about us');

        // Contoh penggunaan dengan multiple data setData
        $this->renderer->setData([
            'products' => [
                ['name' => 'Produk A', 'price' => 100000],
                ['name' => 'Produk B', 'price' => 200000]
            ],
            'category' => 'Electronics'
        ]);

        
        // Merender view dengan data
        return $this->renderer->render('pages/articles/table', ['cache'=>60]);
    }

    /* Method renderString */
    public function dynamic()
    {
        $template = '
            <div class="user-card">
                <h2>John Doe</h2>
                <p>Email: john@example.com</p>
                <p>Role: administrator</p>
            </div>
        ';

        return $this->renderer->renderString($template);
    }


}