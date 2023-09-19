<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        switch (auth()->user()->type) {
        case "admin":
            return view('admin.profile.index');
            break;
        case "client":
            return view('client.profile.index');
            break;
        case "rider":
            return view('rider.profile.index');
            break;
        case "teller":
            return view('teller.profile.index');
            break;
        }
    }

    public function update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/user_profile/',$fileToStore);
        }

        switch (auth()->user()->type) {
        case "admin":
            $user = User::findOrFail(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if(isset($fileToStore)){
                $user->image = $fileToStore;
            }
            $user->update();
            
            return back()->with('success','Profile successfully updated!');
            break;
        case "client":
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'address' => 'required|max:255',
                'dob' => 'required|max:255',
                'contact' => 'required|max:255',
            ]);

            $user = User::findOrFail(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->customer()->update([
                'address' => $request->address,
                'birthdate' => $request->dob,
                'cellphone_number' => $request->contact,
            ]);
            if(isset($fileToStore)){
                $user->image = $fileToStore;
            }
            $user->update();
            
            return back()->with('success','Profile successfully updated!');
            break;
        case "rider":
            return view('rider.profile.index');
            break;
        case "teller":
            return view('teller.profile.index');
            break;
        }
       
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        if($request->new_password != $request->new_password_confirmation){
            return back()->with("error", "Confirmation Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password changed successfully!");
    }
}
