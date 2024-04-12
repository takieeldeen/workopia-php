<?php
    require('../helpers.php');
    use Framework\Database;
    use Framework\Router;
    //Custom autoLoader
    // function loadMissingClass($class){
    //     $path = basePath("Framework/{$class}.php");
    //     if(file_exists($path)){
    //         require($path);
    //     }
    // }

    // spl_autoload_register('loadMissingClass');
    // PSR-4 Autoloader
    require __DIR__ . '/../vendor/autoload.php'; 

    // Instantiating the database connection class
    $config = require basePath('config.php');
    $database = new Database($config);
    // Instantiating the router class
    $router = new Router();
    // Importing registered routes
    $routes = require basePath('routes.php');
    // Capturing the Request method and URI
    $uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

    
    
    $router->route($uri);