<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PomodoroController extends Controller
{
    //
    public function display()
    {

        return view('display');
    }
}
