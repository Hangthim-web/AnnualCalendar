<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testCalendar()
    {
        return view('TestView.testCalendar');
    }
}
