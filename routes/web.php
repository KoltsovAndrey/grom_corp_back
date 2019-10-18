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

$router->get('/key', function() {
    return str_random(32);
});
/**
 * Routes for resource user
 */
// $app->get('user', 'UsersController@all');
// $app->get('user/{id}', 'UsersController@get');
// $app->post('user', 'UsersController@add');
// $app->put('user/{id}', 'UsersController@put');
// $app->delete('user/{id}', 'UsersController@remove');

// $router->get('/login', 'UsersController@login');
$router->post('/login', 'UsersController@login');
$router->post('/logout', 'UsersController@logout');

$router->post('/users/create', 'UsersController@create');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/user/detail', 'UsersController@detail');
});

$router->group(['prefix' => '/role'], function () use ($router) {
    $router->get('/', 'RoleController@list');
    $router->get('/for_id/{id}', 'RoleController@for_id');

    $router->post('/create', 'RoleController@create');
    $router->post('/update', 'RoleController@update');
    $router->post('/delete', 'RoleController@delete');
});

$router->group(['prefix' => '/department'], function () use ($router) {
    $router->get('/', 'DepartmentController@list');
    $router->get('/for_id/{id}', 'DepartmentController@for_id');

    $router->post('/create', 'DepartmentController@create');
    $router->post('/update', 'DepartmentController@update');
    $router->post('/delete', 'DepartmentController@delete');
});

$router->group(['prefix' => '/post'], function () use ($router) {
    $router->get('/', 'PostController@list');
    $router->get('/for_id/{id}', 'PostController@for_id');

    $router->post('/create', 'PostController@create');
    $router->post('/update', 'PostController@update');
    $router->post('/delete', 'PostController@delete');
});
