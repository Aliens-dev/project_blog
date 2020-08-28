<?php


namespace app\Http\Controllers;

use app\Config;
use app\Http\Request;
use GuzzleHttp\Psr7\Response;
use function Http\Response\send;

class Controller
{
    const DR = DIRECTORY_SEPARATOR;

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


    protected function checkAuth() {
        if(! session()->hasAuthSession()) {
            return redirect('/login');
        }
    }


    protected function redirectIfAuthenticated() {
        if(session()->hasAuthSession()) {
            return redirect('/admin');
        }
    }

    protected function json($data) {
        echo json_encode($data);
    }

}