<?php

namespace App\Http\Livewire\Riders;

use Livewire\Component;

class Riders extends Component
{
    public $fname;
    public $email;
    public $password;
    public $password_confirmation;
    public $saved = false;

    public $rules = [
        'fname' => 'required|min:4',
        'email' => 'required|email|string|max:255|unique:users',
        'password' => 'required|string|min:8|same:password_confirmation',
        'password_confirmation' => 'required|string|min:8|same:password'
    ];
    public function render()
    {
        return view('livewire.riders.riders');
    }
    public function resetFields(){
        $this->reset(['fname','email','password','password_confirmation']);
    }
    public function submitForm(){
        
        $this->validate();

    }
}
