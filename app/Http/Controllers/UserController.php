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

    public function changeUserStatus($id){
        $deactivated = User::findOrFail($id);
        $deactivated->update([
            'is_deactivated' => ($deactivated->is_deactivated=='1') ? '0' : '1',
        ]);
        return redirect()->back()->with('message','Successfully Changed!');
    }

}
