<?php

namespace App\Business\Service;
use App\Business\Model\Admin\AdminUser;
use Illuminate\Support\Facades\Cache;

class AuthService{

	public static function login($user)
	{
		$expire = time() + 24 * 60 * 60;

    	$cookie = sprintf("%s#%d#%d", $user['id'], $expire,time());

    	$api_token = md5($cookie);

    	setcookie("api_token", $api_token, $expire,  "/");

    	$user = AdminUser::where([
    		'id'=>$user['id']
    	])->update([
    		'api_token' => $api_token
    	]);

		Cache::put($api_token,$user,24*60);

		// event(new UserLoginEvent($user));
		return [
			'username'=>$user['username'],
			'avatar'=>$user['avatar'],
		];
	}
}