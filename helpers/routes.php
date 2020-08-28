<?php

use app\Route;

    function routes() {
        $route = new Route();

        $route->get('/register', 'HomeController@register');
        $route->get('/login', 'LoginController@index');
        $route->post('/login', 'LoginController@indexPost');

        // Articles Routes

        $route->get('/', 'ArticleController@index');
        $route->get('/articles/{id}', 'ArticleController@get');

        // categories routes
        $route->get('/categories/{id}', 'CategoryController@show');

        // Admin Routes
        $route->get('/admin', 'AdminController@dashboard');
        $route->get('/admin/users', 'AdminController@index');
        $route->post('/admin/users', 'AdminController@store');
        $route->get('/admin/users/{id}', 'AdminController@edit');
        $route->patch('/admin/users/{id}', 'AdminController@update');
        $route->delete('/admin/users/{id}', 'AdminController@destroy');

        $route->post('/admin/logout', 'AdminController@logout');
        // Articles
        $route->get('/admin/articles', 'AdminArticlesController@index');
        $route->post('/admin/articles', 'AdminArticlesController@store');
        $route->get('/admin/articles/{id}', 'AdminArticlesController@edit');
        $route->patch('/admin/articles/{id}', 'AdminArticlesController@update');
        $route->delete('/admin/articles/{id}', 'AdminArticlesController@destroy');

        // Categories

        $route->get('/admin/categories', 'CategoryController@index');
        $route->get('/admin/categories/{id}', 'CategoryController@edit');
        $route->patch('/admin/categories/{id}', 'CategoryController@update');
        $route->post('/admin/categories', 'CategoryController@store');
        $route->delete('/admin/categories/{id}', 'CategoryController@destroy');

        $route->post('/404', 'HomeController@notFound');
        return $route;
    }
