<?php
namespace App\Http\Middleware;

use Closure;
use Validator\Bootstrap;

/**
 * 请求日志
 */
class ValidatorMiddleware
{
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $controller = $this->getController($route[1]);
        $action = $this->getAction($route[1]);
        Bootstrap::init($controller, $action);
        return $next($request);
    }


    /**
     * @param array $action
     * @return mixed|string
     */
    protected function getController(array $action)
    {
        if (empty($action['uses'])) {
            return false;
        }
        if(empty($controller = explode("@", $action['uses']))){
            return false;
        }
        return current($controller);
    }

    /**
     * @param array $action
     * @return mixed|string
     */
    protected function getAction(array $action)
    {
        if (!empty($action['uses'])) {
            $data = $action['uses'];
            if (($pos = strpos($data, "@")) !== false) {
                return substr($data, $pos + 1);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
