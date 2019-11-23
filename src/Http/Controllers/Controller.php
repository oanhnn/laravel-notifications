<?php

namespace Laravel\Notifications\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

/**
 * Class Handler
 *
 * @package     Laravel\Notifications\Http\Controllers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
abstract class Controller extends IlluminateController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
