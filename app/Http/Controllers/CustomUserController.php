<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CustomUserController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $params = request()->path();

        Config::set('session.driver', 'file');
        Config::set('session.cookie', 'ci_session');
        $request->session()->regenerate();

        $_COOKIE['ci_session']=null;
        header('Location: '.env('APP_URL').'/erp/system-logout');
        exit;
        // return view("auth.login");

    }
}
