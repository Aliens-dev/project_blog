<?php


namespace app\Http\Controllers;


use app\DB\Models\Article;

class ArticleController
{

    public function index () {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function get($id) {
        $article = Article::find([$id]);
        return view('articles.get', compact('article'));
    }

    public function update($userId, $articleId)
    {

    }


}