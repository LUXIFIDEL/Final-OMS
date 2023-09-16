<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_no',
        'user_id',
        'status',
        'order',
        'prin_amount',
        'delivery_fee',
        'feedback_status',
        'feedback_msg',
        'rating',
    ];


}
