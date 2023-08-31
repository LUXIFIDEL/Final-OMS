<?php

namespace App\Http\Livewire\Riders;

use Livewire\Component;
use App\Models\{Rider,User};
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\WithPagination;

class Riders extends Component
{
    protected $paginationTheme = 'bootstrap';   
    use WithPagination;
    public $search;
    public $updateMode = false;
    public $fname,$email,$cpnum,$dob,$password,$password_confirmation;

    public $rules = [
        'fname' => 'required|min:4',
        'email' => 'required|email|string|max:255|unique:users',
        'cpnum' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
        'dob' => 'required|date|before:today',
        'password' => 'required|string|min:8|same:password_confirmation',
        'password_confirmation' => 'required|string|min:8|same:password'
    ];

    public function render()
    {
        if($this->search){
            $search = $this->search;
            $riders = Rider::whereHas('user', function($query) use ($search){
                $query->where('name', 'like', '%' .$search. '%')
                ->orWhere('email', 'like', '%' .$search. '%');
            })->with(['user' => function($query) use ($search){
                $query->where('name', 'like', '%' .$search. '%')
                ->orWhere('email', 'like', '%' .$search. '%');
            }])->latest('id')->paginate(6);
        }else{
            $riders = Rider::latest('id')->paginate(6);
        }
        return view('livewire.riders.riders',['riders' => $riders]);
    }

    public function resetFields(){
        $this->updateMode = false;
        $this->reset(['fname','email','password','password_confirmation','cpnum','dob']);
    }

    public function submitForm(){
        $validated = $this->validate();
       
        $user = User::create([
            'name' => $validated['fname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'type' => '3',
        ]);
        $user->rider()->create([
            'user_id' => $user->id,
            'birthdate' => Carbon::parse($validated['dob'])->format('Y-m-d'),
            'cellphone_number' => $validated['cpnum'],
        ]);

        session()->flash('message', 'Rider Successfully Created!');
       
        $this->resetFields();
    }

    public function updatingSearch(){
        $this->updateMode = false;
        $this->resetPage();
    }

    public function edit($id)
    {
        $rider = Rider::with('user')->findOrFail($id);
        $this->rider_id = $rider->id;
        $this->fname = $rider->user->name;
        $this->dob = $rider->birthdate;
        $this->cpnum = $rider->cellphone_number;
        $this->email = $rider->user->email;
        $this->updateMode = true;
    }

    public function updateForm()
    {
        $validatedDate = $this->validate([
            'fname' => 'required|min:4',
            'cpnum' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
            'dob' => 'required|date|before:today',
            'password' => 'nullable|string|min:8|same:password_confirmation',
            'password_confirmation' => 'nullable|string|min:8|same:password'
        ]);
  
        $rider = Rider::with('user')->find($this->rider_id);
        $rider->update([
            'birthdate' => $this->dob,
            'cellphone_number' => $this->cpnum,
        ]);
        $rider->user()->update([
            'name' => $this->fname,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Rider Updated Successfully.');
        $this->resetFields();
    }

    public function delete($id)
    {
        Rider::find($id)->delete();
        session()->flash('deleted', 'Rider Deleted Successfully.');
    }
}
