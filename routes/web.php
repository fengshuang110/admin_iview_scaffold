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

$router->group([
    'middleware'=>['validator'],
],function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    $router->group([
    ], function () use ($router) {
        $router->get('/pay/notify/wechat', ['uses' => 'PayController@wechat_notify']);
        $router->post('/pay/notify/wechat', ['uses' => 'PayController@wechat_notify']);
    });

    $router->group([
    ], function () use ($router) {
        $router->get('/auth/get_user', ['uses' =>'AuthController@getUser']);
        $router->get('/auth/login', ['uses' => 'AuthController@login']);
        $router->get('/auth/logout', ['uses' => 'AuthController@logout']);
        $router->get('/auth/group_menus', ['uses' => 'AuthController@groupMenus']);
    });

    $router->group([
        'middleware'=>['permission'],
    ], function () use ($router) {
        $router->get('user/index', ['uses' => 'UserController@index']);
        $router->get('user/toggle', ['uses' => 'UserController@toggle']);
        $router->post('user/create', ['uses' => 'UserController@create']);
        $router->post('user/update', ['uses' => 'UserController@update']);

        $router->get('role/index', ['uses' => 'RoleController@index']);
        $router->post('role/create', ['uses' => 'RoleController@create']);
        $router->post('role/update', ['uses' => 'RoleController@update']);
        $router->get('role/toggle', ['uses' => 'RoleController@toggle']);
        $router->get('role/options', ['uses' => 'RoleController@options']);

        $router->get('permission/index', ['uses' => 'PermissionController@index']);
        $router->post('permission/create', ['uses' => 'PermissionController@create']);
        $router->post('permission/update', ['uses' => 'PermissionController@update']);
        $router->post('permission/delete', ['uses' => 'PermissionController@delete']);
        $router->get('permission/group', ['uses' => 'PermissionController@group']);

        $router->get('permission_menu/index', ['uses' => 'PermissionMenuController@index']);
        $router->post('permission_menu/create', ['uses' => 'PermissionMenuController@create']);
        $router->post('permission_menu/update', ['uses' => 'PermissionMenuController@update']);

        $router->get('member/index', ['uses' => 'MemberController@index']);
    });
});

