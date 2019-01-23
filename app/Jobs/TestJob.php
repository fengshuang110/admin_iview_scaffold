<?php

namespace App\Jobs;

class TestJob extends Job
{
    private $message='';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // php artisan queue:work --daemon --queue=test --tries=15 --timeout=60 
        var_dump($this->message);
        //http 请求发送功能 参数定义
        //http($url,$params);
    }
}
