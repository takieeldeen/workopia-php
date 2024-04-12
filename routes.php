<?php
    $router->get('/','HomeController@index');
    $router->get('/listings','ListingController@index');
    $router->get('/listings/create','ListingController@create');
    $router->get('/listings/{id}','ListingController@show');
    // $router->get('/listings','controllers/listings/index.php');
    // $router->get('/listing','controllers/listings/show.php');
    // $router->get('/listings/create','controllers/listings/create.php');
    // $router->get('/','controllers/error/404.php');

