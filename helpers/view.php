<?php


use app\Http\Controllers\Controller;

    function view($view, $args = []) {
        return Controller::view($view,$args);
    }