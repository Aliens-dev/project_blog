<?php


namespace app\Http\Controllers;


use app\DB\Models\Article;
use app\DB\Models\Category;
use app\DB\Models\User;

class ArticleController
{

    public function index () {
        $articles = Article::all();
        $latest = Article::limit();
        $categories = Category::limit();
        return view('articles.index',compact(['articles','latest','categories']));
    }

    public function get($id) {
        $article = Article::find([$id]);
        $categories = Category::limit();
        $latest = Article::limit();
        $user = User::find([$article->user_id]);
        return view('articles.get', compact(['article','latest','user','categories']));
    }

}