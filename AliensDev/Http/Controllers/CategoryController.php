<?php


namespace app\Http\Controllers;


use app\App;
use app\DB\Models\Article;
use app\DB\Models\Category;
use app\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->checkAuth();
    }

    public function index()
    {
        $categories  = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function show($id)
    {
        $cat = Category::find([$id]);
        $categories = Category::all();
        $articles = $cat->articles();
        $latest = Article::limit();
        return view('articles.category', compact(['articles','cat','categories','latest']));
    }

    public function store()
    {
        $name = $this->request('name');
        $name = new Validator('name', $name);
        $name = $name->required()->min(3)->max(20);

        if($name->isValid()) {
            $category = null;
            try {
                $category = Category::insert(['name'], [$name->value]);
            }catch (\Exception $e) {
                echo $e->getMessage();
            }
            if($category) {
                session()->setFlashMessages(["Successfully Added"]);
            }else {
                session()->setFlashMessages(["Failed to insert, Already exists!"]);
            }
        }else {
            session()->setFlashMessages($name->getErrors());
        }
        return redirect('/admin/categories');
    }

    public function edit($id)
    {
        $category = Category::find([$id]);
        return view('admin.category.edit', compact(['category']));
    }

    public function update($id)
    {
        $name = $this->request('name');
        $name = new Validator('name', $name);
        $name = $name->required()->min(3)->max(20);

        if($name->isValid()) {
            $category = null;
            try {
                $category = Category::update(['name'],[$name,$id]);
            }catch (\Exception $e) {
                echo $e->getMessage();
            }
            if(! is_null($category)) {
                session()->setFlashMessages(["Successfully Updated"]);
            }else {
                session()->setFlashMessages(["Failed to update, Already exists!"]);
            }
        }else {
            session()->setFlashMessages($name->getErrors());
        }
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        Category::delete($id);
        return redirect('/admin/categories');
    }
}