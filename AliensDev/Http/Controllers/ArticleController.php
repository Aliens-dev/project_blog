<?php


namespace app\Http\Controllers;


use app\DB\Models\Article;
use app\DB\Models\User;

class ArticleController
{

    public function index () {
        $articles = Article::all();
        $latest = Article::limit();
        return view('articles.index',compact(['articles','latest']));
    }

    public function get($id) {
        $article = Article::find([$id]);
        $latest = Article::limit();
        $user = User::find([$article->user_id]);
        return view('articles.get', compact(['article','latest','user']));
    }

    public function update($userId, $articleId)
    {

    }


}