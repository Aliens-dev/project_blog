<?php


namespace app\Http\Controllers;


use app\App;
use app\Config;
use app\DB\Models\Article;
use app\Validator;

class AdminArticlesController extends Controller
{

    public function __construct()
    {
        $this->auth(['index']);
    }

    public function index () {
        $this->checkAuth('index');
        $articles = Article::all();
        return view('admin.articles.index',compact('articles'));
    }

    public function store()
    {
        // validate Title
        $title = new Validator('title', $this->request("title"));
        $body = new Validator('body', $this->request("body"));
        $excerpt = new Validator('excerpt', $this->request("excerpt"));
        $image = $_FILES['image'];
        $title = $title->required()->min(3)->max(50);
        $body = $body->required()->min(3);
        if($title->isValid() && $body->isValid()) {

            if(isset($image)) {
                $uploadDirectory = '/uploads/'.$image['name'];
                $locationOnDisc = Config::get('PUBLIC'). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR.$image['name'];
                move_uploaded_file($image['tmp_name'], $locationOnDisc);
            }

            $query = App::getDB()->prepare("INSERT into articles(title, body,excerpt,image,user_id) VALUES(?,?,?,?,?)",[$title->value,$body->value,$excerpt->value,$uploadDirectory,session()->getAuthSession()['user_id']],Article::class,null);
            if($query) {
                session()->setFlashMessages(["Successfully Added"]);
            }else {
                session()->setFlashMessages(["Failed to Add"]);
            }
        }else {
            session()->setFlashMessages(array_merge($title->getErrors(), $body->getErrors()));
        }
        return redirect('/admin/articles');
    }
    public function edit($id)
    {
        $this->checkAuth('index');
        $article = Article::find([$id]);
        return view('admin.articles.edit', compact('article'));
    }

    public function update($id)
    {
        // validate Title
        $title = new Validator('title', $this->request("title"));
        $body = new Validator('body', $this->request("body"));
        $excerpt = new Validator('excerpt', $this->request("excerpt"));

        $title = $title->required()->min(3)->max(50);
        $body = $body->required()->min(3);


        if($title->isValid() && $body->isValid()) {
            $image = $_FILES['image'];
            if(isset($image)) {
                $uploadDirectory = '/uploads/'.$image['name'];
                $locationOnDisc = Config::get('PUBLIC'). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR.$image['name'];
                move_uploaded_file($image['tmp_name'], $locationOnDisc);
                $query = App::getDB()->prepare("UPDATE articles set title=?, body=?, excerpt=?, image=?,user_id=? WHERE id=?",[$title->value,$body->value,$excerpt->value,$uploadDirectory,session()->getAuthSession()['user_id'],$id],Article::class,null);
            }else {
                $query = App::getDB()->prepare("UPDATE articles set title=?, body=?, excerpt=?,user_id=? WHERE id=?",[$title->value,$body->value,$excerpt->value,session()->getAuthSession()['user_id'],$id],Article::class,null);
            }

            if($query) {
                session()->setFlashMessages(["Successfully Updated"]);
            }else {
                session()->setFlashMessages(["Failed to Update"]);
            }
        }else {
            session()->setFlashMessages(array_merge($title->getErrors(), $body->getErrors()));
            return redirect('/admin/articles/'. $id);
        }
        return redirect('/admin/articles');
    }

    public function destroy($id) {
        App::getDB()->delete("articles", [$id]);
        return redirect('/admin/articles');
    }

}