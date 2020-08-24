<?php


namespace app\Http\Controllers;


use app\App;
use app\DB\Models\Article;
use app\DB\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->auth(['index']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index() {
        $this->checkAuth('index');
        $users = User::all();
        return view('admin.index',compact('users'));
    }

    public function logout() {
        session()->clearAuthSession();
        return redirect('/');
    }
}