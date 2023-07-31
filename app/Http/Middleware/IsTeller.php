<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsTeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        switch (auth()->user()->type) {
        case "admin":
            return redirect('admin/home')->with('error',"You don't have admin access.");
            break;
        case "client":
            return redirect('home')->with('error',"You don't have admin access.");
            break;
        case "rider":
            return redirect('rider/home')->with('error',"You don't have admin access.");
            break;
        default:
            return $next($request);
        }
    }
}
