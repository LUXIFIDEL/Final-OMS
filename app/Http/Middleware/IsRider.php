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

        $roles = [
            'admin' => 'You don\'t have admin access.',
            'client' => 'You don\'t have admin access.',
            'teller' => 'You don\'t have admin access.',
        ];

        if (array_key_exists($user->role, $roles)) {
            return redirect($user->role . '/home')->with('error', $roles[$user->role]);
        }

        return $next($request);
    }
}
