<?php

use app\Route;

    function routes() {
        $route = new Route();
        $route->get('/', 'HomeController@index');
        $route->get('/register', 'HomeController@register');
        $route->get('/login', 'LoginController@index');
        $route->post('/login', 'LoginController@indexPost');

        // Articles Routes

        $route->get('/articles', 'ArticleController@index');
        $route->get('/articles/{id}', 'ArticleController@get');

        // Admin Routes
        $route->get('/admin', 'AdminController@dashboard');
        $route->get('/admin/users', 'AdminController@index');
        $route->post('/admin/users', 'AdminController@store');
        $route->get('/admin/users/{id}', 'AdminController@get');
        $route->patch('/admin/users/{id}', 'ArticlesController@update');
        $route->get('/admin/users/{id}/users/{id}', 'ArticlesController@update');
        $route->delete('/admin/users', 'AdminController@destroy');
        $route->post('/admin/logout', 'AdminController@logout');
        // Articles
        $route->get('/admin/articles', 'AdminArticlesController@index');
        $route->post('/admin/articles', 'AdminArticlesController@store');
        $route->patch('/admin/articles', 'AdminArticlesController@update');
        $route->delete('/admin/articles', 'AdminArticlesController@destroy');

        $route->post('/404', 'HomeController@notFound');
        return $route;
    }