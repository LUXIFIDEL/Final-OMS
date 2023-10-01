<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsRider
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
        $user = auth()->user();
        
        if ($user->is_deactivated == 1) {
            auth()->logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with(['data' => 'This user account is deactivated by the admin!']);
        }

        switch (auth()->user()->role) {
        case "admin":
            return redirect('admin/home')->with('error',"You don't have admin access.");
            break;
        case "client":
            return redirect('client/home')->with('error',"You don't have admin access.");
            break;
        case "rider":
            return $next($request);
            break;
        case "teller":
            return redirect('teller/home')->with('error',"You don't have admin access.");
            break;
        }
    }
}
