<?php


namespace app\Http\Controllers;

use app\Config;
use app\DB\Database;
use app\Http\Request;
use app\Session;
use GuzzleHttp\Psr7\Response;
use function Http\Response\send;
use function Sodium\compare;

class Controller
{
    const DR = DIRECTORY_SEPARATOR;
    protected $auth = [];

    protected function request($key="") {
        $request = new Request();
        if($key) {
            return $request->$key;
        }
        return $request;
    }

    protected function response($data, $header = 'status',$code = 200) {
        $response = new Response();
        $response->withHeader($header,$code);
        $response->getBody()->write(json_decode(compact('data')));
        send($response);
    }

    public static function view($view, $args = []) {
        $view_path = Config::get('DIR') . self::DR . "views" . self::DR;
        $get_view = str_replace('.',self::DR,$view);
        extract($args);
        ob_start();
        include  $view_path . $get_view . '.php';
        $content = ob_get_clean();
        require $view_path.'app.php';
    }

    protected function auth($auth) {
        $this->auth = $auth;
    }

    protected function checkAuth($method) {
        foreach ($this->auth as $item) {
            if($item  == $method) {
                if(! session()->hasAuthSession()) {
                    return redirect('/login');
                }
            }
        }
    }

    protected function redirectIfAuthenticated($method) {
        foreach ($this->auth as $item) {
            if($item  == $method) {
                if(session()->hasAuthSession()) {
                    return redirect('/admin');
                }
            }
        }
    }

    protected function json($data) {
        echo json_encode($data);
    }

}