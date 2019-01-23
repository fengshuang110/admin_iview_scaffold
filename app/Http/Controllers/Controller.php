<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Business\Traits\RespTrait;
use App\Business\Traits\ValidateTrait;

class Controller extends BaseController
{
    use RespTrait;
    use ValidateTrait;
}
