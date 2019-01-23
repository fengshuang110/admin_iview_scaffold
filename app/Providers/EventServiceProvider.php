<?php

namespace App\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ExampleEvent' => [
            'App\Listeners\ExampleListener',
        ],
    ];

    public function boot()
    {
        parent::boot();

        /**
         * 根据PHP习惯，fetch mode 设置为数组返回
         * 框架使用的表除外（Lumen框架使用对象取值）
         */
        Event::listen(StatementPrepared::class, function ($event) {
            if(! $this->isFrameworkTable($event->statement)) {
                $event->statement->setFetchMode(\PDO::FETCH_ASSOC);
            }
        });

        /**
         * SQL日志
         */
        DB::listen(function ($query) {
            $context = [
                'sql'      => $query->sql,
                'bindings' => $query->bindings,
                'time'     => $query->time
            ];
            Log::critical('SQL日志', $context);
        });
    }
    
    /**
     * 是否框架使用的表
     */
    private function isFrameworkTable($statement)
    {
        $sql = strtolower($statement->queryString);
        $sta = strpos($sql, 'from') + 4;
        $end = strpos($sql, 'where');
        $end = $end === false ? strlen($sql) : $end;
        $len = $end - $sta;
        $table = trim(substr($sql, $sta, $end - $sta), ' `');

        return in_array($table, [
            'failed_jobs',
        ]);
    }

}
