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
// $router->post('/user/detail', ['middleware' => 'auth', 'UsersController@for_id']);
/**
 * Routes for resource role
 */
// $app->get('role', 'RolesController@all');
// $app->get('role/{id}', 'RolesController@get');
// $app->post('role', 'RolesController@add');
// $app->put('role/{id}', 'RolesController@put');
// $app->delete('role/{id}', 'RolesController@remove');
$router->group(['prefix' => '/role'], function () use ($router) {
    $router->get('/', 'RoleController@list');
});
