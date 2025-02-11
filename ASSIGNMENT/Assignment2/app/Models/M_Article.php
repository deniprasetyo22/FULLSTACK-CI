<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;

class M_Article
{
   private $articles = [];

   public function __construct()
   {
    $this->articles = [
        new Article(["id" => 1, "title" => "Hello World", "content" => "Content of Hello World"]),
        new Article(["id" => 2, "title" => "Hello PHP", "content" => "Content of Hello PHP"]),
        new Article(["id" => 3, "title" => "Hello JavaScript", "content" => "Content of Hello JavaScript"]),
    ];
   }

   public function getAllArticles()
   {
       return $this->articles;
   }

   public function getArticleById($id)
   {
    foreach ($this->articles as $article) {
        if ($article->getId() == $id) {
            return $article;
        }
    }
    return null;
   }

   public function addArticle(Article $article)
   {
    $this->articles[] = $article;
   }

   public function updateArticle(Article $article)
   {
    foreach ($this->articles as $key => $a) {
        if ($a->getId() == $article->getId()) {
            $this->articles[$key] = $article;
            return true;
        }
    }
    return false;
   }

   public function deleteArticle($id)
   {
    foreach ($this->articles as $key => $a) {
        if ($a->getId() == $id) {
            unset($this->articles[$key]);
            return true;
        }
    }
    return false;
   }
}