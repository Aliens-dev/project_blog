<?php


namespace app\Http\Controllers;


use app\App;
use app\DB\Models\User;
use app\Session;
use app\Validator;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->auth(['index', 'indexPost']);
    }

    public function index() {
        $this->redirectIfAuthenticated('index');
        return view('login.index');
    }

    public function indexPost()
    {
        $email = $this->request('email');
        $password = $this->request('password');

        // Validate Email
        $validateEmail = new Validator("email",$email);
        $email = $validateEmail->email()->required();
        // Validate Password
        $validatePassword = new Validator("password",$password);
        $password = $validatePassword->min(3)->required();


        if($email->isValid() && $password->isValid()) {
            $user = App::getDB()->prepare("SELECT * from users WHERE email = ? AND password = ?",[$email->value,$password->value],User::class);
            if($user) {
                session()->setAuthSession(['user' => $user]);
                return redirect('/admin');
            }else {
                session()->setFlashMessages(['Username or Password wrong!']);
            }
        }else {
            session()->setFlashMessages(array_merge($email->getErrors(), $password->getErrors()));
        }
        return redirect("/login");
    }
}