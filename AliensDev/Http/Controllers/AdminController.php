<?php


namespace app\Http\Controllers;


use app\App;
use app\DB\Models\Article;
use app\DB\Models\Category;
use app\DB\Models\User;
use app\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->checkAuth();
    }

    public function dashboard()
    {
        $users = User::count();
        $articles = Article::count();
        $categories = Category::count();
        return view('admin.dashboard', compact(['users', 'articles','categories']));
    }

    public function index() {
        $users = User::all();
        return view('admin.index',compact('users'));
    }

    public function edit($id)
    {
        $user = User::find([$id]);
        return view('admin.edit',compact('user'));
    }

    public function store()
    {
        // validate Title
        $name = new Validator('name', $this->request("name"));
        $email = new Validator('email', $this->request("email"));
        $password = new Validator('password', $this->request("password"));

        $name = $name->required()->min(3);
        $email = $email->required()->email();
        $password = $password->required();

        if($email->isValid() && $password->isValid() && $name->isValid()) {
            $password = hash("sha256",$password->value);
            $query = User::insert(['name','email','password'],[$name->value,$email->value,$password]);
            if(! is_null($query)) {
                session()->setFlashMessages(["Successfully Added"]);
            }else {
                session()->setFlashMessages(["Failed to Added"]);
            }
        }else {
            session()->setFlashMessages(array_merge($name->getErrors(), $email->getErrors(), $password->getErrors()));
        }
        return redirect('/admin/users');
    }

    public function update($id)
    {
        $email = new Validator('email', $this->request("email"));
        $name = new Validator('name', $this->request("name"));
        $password = new Validator('password', $this->request("password"));

        $name = $name->required()->min(3);
        $email = $email->required()->email();
        $password = $password->required();
        if($email->isValid() && $password->isValid() && $name->isValid()) {
            $password = hash("sha256",$password->value);
            $query = User::update(['name','email','password'],[$name,$email,$password,$id]);
            if(! is_null($query)) {
                session()->setFlashMessages(["Successfully Updated"]);
            }else {
                session()->setFlashMessages(["Failed to Update"]);
            }
        }else {
            session()->setFlashMessages(array_merge($name->getErrors(), $email->getErrors(), $password->getErrors()));
        }
        return redirect('/admin/users');
    }

    public function destroy($id)
    {
        User::delete($id);
        return redirect('/admin/users');
    }
    public function logout() {
        session()->clearAuthSession();
        return redirect('/');
    }
}