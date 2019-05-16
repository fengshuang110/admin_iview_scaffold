<?php

namespace App\Http\Middleware;

use App\Business\Utils\Tool;
use Closure;
use Illuminate\Support\Facades\Log;
use App\Events\ExampleEvent;

/**
 * 请求日志
 */
class LogMiddleware
{
    public function handle($request, Closure $next)
    {
        // before action
        $start_time = Tool::microtime();
        // do action
        $response = $next($request);
        // after action
        $cost = Tool::microtime() - $start_time;
        $this->storeLog($request, $response, $cost);
        event(new ExampleEvent("触发事件注册"));
        return $response;
    }

    /**
     * 文件记录所有请求日志
     */
    private function storeLog($request, $response, $cost)
    {
        $path = trim($request->path(), '#?');
        $context = [
            'path'  => $path,
            'ip'    => Tool::getClientIp(),
            'query' => $request->all(),
            'response' => $response->content(),
            'cost' => $cost,
        ];
        Log::critical('_ACCESS_', $context);

        $xhprof_data = xhprof_disable();
        include_once "/data/code/xhprof/xhprof_lib/utils/xhprof_lib.php";
        include_once "/data/code/xhprof/xhprof_lib/utils/xhprof_runs.php";
        // save raw data for this profiler run using default
        // implementation of iXHProfRuns.
        $xhprof_runs = new \XHProfRuns_Default();
        // save the run under a namespace "xhprof_foo"
        $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
    }
}
