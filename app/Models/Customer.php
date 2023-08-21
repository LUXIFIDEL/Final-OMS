<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'birthdate',
        'cellphone_number',
        'address'
    ];

    protected function gender(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["Male", "Female"][$value],
        );
    }

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
    
}
