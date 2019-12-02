<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');
$router->get('/penelitian', 'PenelitianController@show');

$router->get('/info/download/{id}', 'InfoController@download');
$router->post('/info/download/{id}', 'InfoController@download');
$router->put('/info/update/{id}', 'InfoController@update');
$router->post('/info/save', 'InfoController@save');
$router->get('/info', 'InfoController@info');