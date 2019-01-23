<?php

namespace App\Events;

class ExampleEvent extends Event
{
	protected $message = "";
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        //
    	$this->message = $message;
    }

    public function getMessage(){
    	return  $this->message;
    }
}
