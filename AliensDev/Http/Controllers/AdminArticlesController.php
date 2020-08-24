<?php


namespace app\Http\Controllers;


use app\DB\Models\Article;

class AdminArticlesController extends Controller
{
    public function index () {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function update($userId, $articleId)
    {

    }

    public function get() {

    }
}