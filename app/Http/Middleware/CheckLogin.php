<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getuserid = getUserId();
        if(!Employee::where('user_id',$getuserid)->exists()){
            // dd(to_route('login'));
        // return redirect()->route('login');
        // dd(request()->path());
        $params = request()->path();
         header('Location: '.env('APP_URL').'/erp/login?redirect_to=/modules/'.$params);
         exit;


        }
        return $next($request);
    }
}
