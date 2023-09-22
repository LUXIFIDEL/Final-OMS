<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsClient
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
        switch (auth()->user()->role) {
        case "admin":
            return redirect('admin/home')->with('error',"You don't have admin access.");
            break;
        case "client":
            return $next($request);
            break;
        case "rider":
            return redirect('rider/home')->with('error',"You don't have admin access.");
            break;
        case "teller":
            return redirect('teller/home')->with('error',"You don't have admin access.");
            break;
        }
    }
}
