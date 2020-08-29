<?php

    session_start();
    require("../vendor/autoload.php");
    use app\App;

    //get Routes
    $router = routes();

    // App Loader
    $app = new App($router->routes);

    // Launch App
    $app->launch();