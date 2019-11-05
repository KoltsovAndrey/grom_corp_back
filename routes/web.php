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
    return 'grom corp api';
});

// $router->get('/key', function() {
//     return str_random(32);
// });

$router->post('/login', 'JournalController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    // $router->post('/user/detail', 'UserController@detail');

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

    $router->group(['prefix' => '/user'], function () use ($router) {
        $router->get('/', 'UserController@list');
        $router->get('/for_id/{id}', 'UserController@for_id');
        $router->post('/create', 'UserController@create');
        $router->post('/update', 'UserController@update');
        $router->post('/delete', 'UserController@delete');
    });

    $router->group(['prefix' => '/news'], function () use ($router) {
        $router->get('/', 'NewsController@list');
        $router->get('/for_id/{id}', 'NewsController@for_id');
        $router->post('/create', 'NewsController@create');
        $router->post('/update', 'NewsController@update');
        $router->post('/delete', 'NewsController@delete');
    });

    $router->group(['prefix' => '/journal'], function () use ($router) {
        $router->get('/', 'JournalController@list');
        $router->get('/for_id/{id}', 'JournalController@for_id');
    });

    $router->post('/logout', 'JournalController@logout');
});