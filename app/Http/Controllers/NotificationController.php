<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificationList(){
        return view('customer.notification');
    }
}
