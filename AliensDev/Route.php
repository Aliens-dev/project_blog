<?php


namespace app;


class Route
{
    public $routes = [];

    public function get($route, $controller) {
        $this->routes [] = [
            'type' => 'GET',
            'route' => $route,
            'controller' => $controller
        ];
    }
    public function post($route,$controller) {
        $this->routes [] = [
            'type' => 'POST',
            'route' => $route,
            'controller' => $controller
        ];
    }
    public function patch($route,$controller) {
        $this->routes [] = [
            'type' => 'PATCH',
            'route' => $route,
            'controller' => $controller
        ];
    }
    public function delete($route,$controller) {
        $this->routes [] = [
            'type' => 'DELETE',
            'route' => $route,
            'controller' => $controller
        ];
    }

}