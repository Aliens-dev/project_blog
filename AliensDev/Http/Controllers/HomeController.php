<?php


namespace app\Http\Controllers;


class HomeController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function notFound() {
        return view('404');
    }
}