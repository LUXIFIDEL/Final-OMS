<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;
use App\Models\{User,Customer,ChMessage};
use Livewire\WithPagination;

class Customers extends Component
{
    public $search;
    protected $paginationTheme = 'bootstrap';   
    use WithPagination;

    public function render()
    {
        if($this->search){
            $search = $this->search;
            $user_customers = Customer::whereHas('user', function($query) use ($search){
                $query->where('name', 'like', '%' .$search. '%')
                ->orWhere('email', 'like', '%' .$search. '%');
            })->with(['user' => function($query) use ($search){
                $query->where('name', 'like', '%' .$search. '%')
                ->orWhere('email', 'like', '%' .$search. '%');
            }])->latest('id')->paginate(6);
        }else{
            $user_customers = Customer::latest('id')->paginate(6);
        }
        $user_customers->map(function($new_item){
            $user = User::findOrFail($new_item->user_id);
            $new_item->name = $user->name;
            $new_item->email = $user->email;
            $new_item->role = $user->role;
            $new_item->image = $user->image;
            return $new_item;
        });
        return view('livewire.customers.customers',['count_message' => ChMessage::where('seen', false)->count(),'user_customers' => $user_customers]);
      
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
