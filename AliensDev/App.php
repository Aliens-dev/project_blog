<?php

namespace app;

use app\DB\Database;

class App
{
    const CONTROLLERS_PATH = 'app\\Http\\Controllers\\';

    public $routes;
    public $slug;
    public $params = [];
    public $selectedRoute;

    public function __construct($routes)
    {
        $this->routes = $routes;
        $this->load();
    }

    public function load()
    {
        $filterRoutes = [];
        $params = [];
        $slug = $_SERVER['REQUEST_URI'];
        $request_method = 'GET';
        if(isset($_REQUEST['_method'])) {
            $request_method = $_REQUEST['_method'];
        }else {
            $request_method = $_SERVER['REQUEST_METHOD'];
        }
        if(strlen($slug) > 1 && $slug[- 1] === '/') {
            $slug = preg_replace('/\/$/','', $slug);
        }
        $this->slug = $slug;

        $slug_parts = explode('/',$this->slug);

        foreach ($this->routes as $route) {
            if(strtolower($request_method) == strtolower($route['type'])) {
                if($route['route'] == $this->slug) {
                    array_push($filterRoutes, $route);
                    break;
                }else {
                    $route_slugs = explode('/',$route['route']);
                    if(count($route_slugs) === count($slug_parts)) {
                        for($i = 0; $i < count($route_slugs); $i++) {
                            if($route_slugs[$i] !== $slug_parts[$i]) {
                                if(strlen($route_slugs[$i]) && $route_slugs[$i][0] === "{") {
                                    $params[] = $i;
                                    if(! $this->element_exists($filterRoutes, $route['route'])) {
                                        $filterRoutes [] = $route;
                                    }
                                }else {
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        if(! count($filterRoutes)) {
            $filterRoutes [] = [
                'type' => 'GET',
                'route' => '/404',
                'controller' => 'HomeController@notFound',
            ];
        }
        for($i = 0;$i<count($params); $i++) {
            $this->params[] = $slug_parts[$params[$i]];
        }

        $this->selectedRoute = $filterRoutes[0];
    }

    public function launch()
    {

        // split the controller by @
        $parts = explode('@',$this->selectedRoute['controller']);
        $controller = self::CONTROLLERS_PATH.$parts[0];
        $method = $parts[1];
        //$params = preg_match_all('/{[a-zA-Z0-9]+}/',$this->slug);

        // instantiate the controller
        $controllerInstance =  new $controller();
        // call the method:
        call_user_func_array([$controllerInstance, $method],$this->params);
        //$controllerInstance->$method();
    }

    private function element_exists($arr, $value) {
        for($j = 0;$j < count($arr); $j++) {
            if($arr[$j]['route'] == $value) {
                return true;
            }
        }
        return false;
    }

    public static function getDB() {
        return new Database();
    }
}