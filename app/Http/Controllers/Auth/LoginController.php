<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            if ($user->is_deactivated == 1) {
                auth()->logout();
                $request->session()->invalidate();
                return redirect()->route('login')->with(['data' => 'This user account is deactivated by the admin!']);
            }

            $roleRedirects = [
                'admin' => 'admin/home',
                'client' => 'client/home',
                'rider' => 'rider/home',
            ];

            return redirect($roleRedirects[$user->role] ?? 'teller/home');
        }

        return redirect()->route('login')->with(['data' => 'Invalid credentials! Check your email address and password!']);
    }

}
