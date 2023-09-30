<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.account.index',[
            'get_user' => User::where('role', 0)->orWhere('role', 3)->get(),
        ]);
    }

}
