<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\{User,Customer,Gender};
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public function render()
    {
        $user_customers = Customer::paginate();
        $user_customers->map(function($new_item){
            $user = User::findOrFail($new_item->user_id);
            $new_item->name = $user->name;
            $new_item->email = $user->email;
            $new_item->type = $user->type;
        });
        return view('livewire.admin.customers',['user_customers' => $user_customers]);
    }
}
