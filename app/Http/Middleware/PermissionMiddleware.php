<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Business\Service\RoleService;
use LogicException;
/**
 * 权限拦截器
 */
class PermissionMiddleware
{
    public function handle($request, Closure $next)
    {
    	if(env('APP_ENV') == 'test' || env('APP_ENV') == 'local'){
    		return $next($request);
    	}
    	$user = Auth::user();
        if($user['id'] == 1){
            return $next($request);
        }
    	$path = $request->path();

    	if(!RoleService::getInstance()->hasPermission($user['role_id'],$path)){
    		 throw new LogicException("权限不足");
    	}
       	return $next($request);
    }

}
