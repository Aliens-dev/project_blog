<?php


namespace app\Http\Controllers;


use app\App;
use app\DB\Models\Article;
use app\DB\Models\User;
use app\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->auth(['index']);
    }

    public function dashboard()
    {
        $this->checkAuth('index');
        $users = User::count();
        $articles = Article::count();
        return view('admin.dashboard', compact(['users', 'articles']));
    }

    public function index() {
        $this->checkAuth('index');
        $users = User::all();
        return view('admin.index',compact('users'));
    }

    public function edit($id)
    {
        $this->checkAuth('index');
        $user = User::find([$id]);
        return view('admin.edit',compact('user'));
    }

    public function store()
    {
        $this->checkAuth('index');
        // validate Title
        $name = new Validator('name', $this->request("name"));
        $email = new Validator('email', $this->request("email"));
        $password = new Validator('password', $this->request("password"));

        $name = $name->required()->min(3);
        $email = $email->required()->email();
        $password = $password->required();

        if($email->isValid() && $password->isValid() && $name->isValid()) {
            $password = hash("sha256",$password->value);
            $query = App::getDB()->prepare("INSERT INTO users(name,email,password) VALUES (?,?,?)",[$name->value,$email->value,$password],User::class,null);
            if($query) {
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
        $this->checkAuth('index');
        $email = new Validator('email', $this->request("email"));
        $name = new Validator('name', $this->request("name"));
        $password = new Validator('password', $this->request("password"));

        $name = $name->required()->min(3);
        $email = $email->required()->email();
        $password = $password->required();
        if($email->isValid() && $password->isValid() && $name->isValid()) {
            $password = hash("sha256",$password->value);
            $query = App::getDB()->prepare("UPDATE users set name=?,email=?,password=? WHERE id=?",[$name->value,$email->value,$password,$id],User::class,null);
            if($query) {
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
        $this->checkAuth('index');
        App::getDB()->delete("users", [$id]);
        return redirect('/admin/users');
    }
    public function logout() {
        $this->checkAuth('index');
        session()->clearAuthSession();
        return redirect('/');
    }
}