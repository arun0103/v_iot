<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class SuperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user = Auth::user();
            if(!$user==null)
            {

                if(!$user->role=='A')
                {
                    //you can throw a 401 unauthorized error here instead of redirecting back
                    return redirect()->back(); //this redirects all non-admins back to their previous url's
                }
            }

        }
        catch(Exception $e){
            e.printstracktrace();
            return view('login');

        }



        return $next($request);
    }
}
