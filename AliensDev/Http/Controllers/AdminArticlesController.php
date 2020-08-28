<?php


namespace app\Http\Controllers;


use app\App;
use app\Config;
use app\DB\Models\Article;
use app\DB\Models\Category;
use app\Validator;

class AdminArticlesController extends Controller
{

    public function __construct()
    {
        $this->checkAuth();
    }

    public function index () {
        $articles = Article::all();
        $categories = Category::all();
        return view('admin.articles.index',compact(['articles','categories']));
    }

    public function store()
    {
        // validate Title
        $title = new Validator('title', $this->request("title"));
        $body = new Validator('body', $this->request("body"));
        $excerpt = new Validator('excerpt', $this->request("excerpt"));
        $categories = $this->request('categories');
        $image = $_FILES['image'];
        $title = $title->required()->min(3)->max(50);
        $body = $body->required()->min(3);
        if($title->isValid() && $body->isValid()) {
            if(isset($image)) {
                $uploadDirectory = '/uploads/'.$image['name'];
                $locationOnDisc = Config::get('PUBLIC'). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR.$image['name'];
                move_uploaded_file($image['tmp_name'], $locationOnDisc);
            }

            $query = Article::insert(['title','body','excerpt','image','user_id'], [$title,$body,$excerpt,$uploadDirectory,session()->getAuthSession()['user_id']]);
            if($query) {

                $article = Article::find([$query]);

                foreach ($categories as $category) {
                    $cat = Category::find([$category]);
                    $article->addCategory($cat);
                }

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
        $article = Article::find([$id]);
        $categories = Category::all();
        $article_categories = $article->categories();
        return view('admin.articles.edit', compact(['article','categories','article_categories']));
    }

    public function update($id)
    {
        // validate Title
        $title = new Validator('title', $this->request("title"));
        $body = new Validator('body', $this->request("body"));
        $excerpt = new Validator('excerpt', $this->request("excerpt"));

        $title = $title->required()->min(3)->max(50);
        $body = $body->required()->min(3);
        $categories = $this->request('categories');

        if($title->isValid() && $body->isValid()) {
            $image = $_FILES['image'];
            if($image['size']) {
                $uploadDirectory = '/uploads/'.$image['name'];
                $locationOnDisc = Config::get('PUBLIC'). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR.$image['name'];
                move_uploaded_file($image['tmp_name'], $locationOnDisc);
                $query = Article::update(['title','body','excerpt','image','user_id'],[$title,$body,$excerpt,$uploadDirectory,session()->getAuthSession()['user_id'],$id]);
            }else {
                $query = Article::update(['title','body','excerpt','user_id'],[$title,$body,$excerpt,session()->getAuthSession()['user_id'],$id]);
            }
            if(!is_null($query)) {
                $article = Article::find([$id]);
                $article->clearCategories();

                foreach ($categories as $category) {
                    $cat = Category::find([$category]);
                    $article->addCategory($cat);
                }
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
        Article::delete($id);
        return redirect('/admin/articles');
    }

}