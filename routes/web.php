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


// $router->group([
// ], function () use ($router) {
// 	$router->get('/test/excel', ['uses' => 'ExampleController@excel']);
// 	$router->get('/queue/rabbitMq', ['uses' => 'QueueController@rabbitMq']);
// 	$router->get('/sms/send', ['uses' => 'SmsController@send']);
// 	//友盟推送
// 	$router->get('/test/umeng', ['uses' => 'ExampleController@umeng']);
// 	//支付宝充值
// 	$router->get('/pay/alipay', ['uses' => 'PayController@alipay']);
// 	//微信充值
// 	$router->get('/pay/wechat', ['uses' => 'PayController@wechat']);
// 	// 支付宝打款
// 	$router->get('/pay/transfer/alipay', ['uses' => 'PayController@transferAlipay']);
// 	//微信打款
// 	$router->get('/pay/transfer/wechat', ['uses' => 'PayController@transferWechat']);
// 	//微信  QQ 微博三方登录
// 	$router->get('/oauth/redirect', ['uses' => 'OauthController@oauthRedirect']);
// 	$router->get('/oauth/indentify', [ 'as' => 'oauthIndentify','uses' => 'OauthController@indentify']);
// });


// $router->group([
// 	'middleware' => ['encrypt'],//AES RSA加解密
// ], function () use ($router) {
// 	$router->get('/encrypt/demo', ['uses' => 'EncryptController@demo']);
// });


// $router->group([
// ], function () use ($router) {
// 	$router->get('/test/psr0', ['uses' => 'TestController@psr0']);
// });


// $router->group([
// 	'prefix' => 'admin',//AES RSA加解密
// 	'namespace' => '\App\Http\Controllers\Admin',
// ], function () use ($router) {

// 	$router->post('/auth/login', ['uses' => 'AuthController@login']);
// 	$router->get('/user/info', ['uses' => 'UserController@info']);
// 	$router->get('/user', ['uses' => 'UserController@pages']);
// 	$router->get('/permissions', ['uses' => 'PermissionController@allPermissions']);
// 	$router->get('/permission', ['uses' => 'PermissionController@pages']);
// 	$router->get('/permission/menu', ['uses' => 'PermissionController@permissionMenu']);
// 	$router->post('/permission/menu/create', ['uses' => 'PermissionMenuController@create']);
// 	$router->post('/permission/menu/delete', ['uses' => 'PermissionMenuController@delete']);
	

// });

$router->group([
], function () use ($router) {
	$router->get('/auth/get_user', ['uses' =>'AuthController@getUser']);
	$router->post('/auth/login', ['uses' => 'AuthController@login']);
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

