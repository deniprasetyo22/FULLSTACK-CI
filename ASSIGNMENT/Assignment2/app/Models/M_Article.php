<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;

class M_Article extends Model
{
    private $articles = [];

    public function __construct()
    {
        $this->articles = [
            new Article(['id'=>1, 'title'=>'Article 1', 'content'=>'Content 1']),
            new Article(['id'=>2, 'title'=>'Article 2', 'content'=>'Content 2']),
            new Article(['id'=>3, 'title'=>'Article 3', 'content'=>'Content 3']),
        ];
    }

    public function getAllArticles()
    {
        return $this->articles;
    }

    public function getArticleBySlug($slug)
    {
        foreach ($this->articles as $article) {
            if ($article->getSlug() == $slug) {
                return $article;
            }
        }

        return null;
    }


    public function createArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    public function updateArticle($slug, array $data)
    {
        foreach ($this->articles as &$article) {
            if ($article->getSlug() == $slug) {
                $article->setId($data['id'] ?? $article->getId());
                $article->setTitle($data['title'] ?? $article->getTitle());
                $article->setContent($data['content'] ?? $article->getContent());
                return true;
            }
        }
        return false;
    }

    public function deleteArticle($slug)
    {
        foreach ($this->articles as $key => $article) {
            if ($article->getSlug() == $slug) {
                unset($this->articles[$key]);
                $this->articles = array_values($this->articles);
                return true;
            }
        }
        return false;
    }
}