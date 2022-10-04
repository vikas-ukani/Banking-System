<?php

namespace App\Http\Controllers;

use App\Traits\MessageTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use MessageTrait;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
