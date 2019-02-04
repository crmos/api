<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {

    }

    public function view($view, $data = array(), $mergeData = array())
    {
        return View::make('modules.'.$view, $data, $mergeData);
    }
}
