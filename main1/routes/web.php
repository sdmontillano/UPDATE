<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Unsecured routes
$router->get('/users1', ['uses' => 'UserController@index']);
$router->post('/users1', ['uses' => 'UserController@add']);
$router->get('/users1/{id}', ['uses' => 'UserController@show']);
$router->put('/users1/{id}', ['uses' => 'UserController@update']);
$router->delete('/users1/{id}', ['uses' => 'UserController@delete']);
