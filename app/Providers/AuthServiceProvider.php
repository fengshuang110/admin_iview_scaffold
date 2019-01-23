<?php

namespace App\Providers;

use App\Business\Model\Admin\AdminUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use LogicException;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
             $user = AdminUser::where('id', 1)->first();
             return $user;
             if(isset($_COOKIE['api_token'])){
                $token = $_COOKIE['api_token'];

                $user = AdminUser::where('api_token', $token)->first();

                if(empty($user)){
                     throw new LogicException("用户暂未登录", 401);
                }
               
                return $user;
            }else{
                throw new LogicException("用户暂未登录", 401);
            }
        });
    }
}
