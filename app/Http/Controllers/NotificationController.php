<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function notificationList(){
        return view('customer.notification',[
            'users' => User::findOrFail(auth()->user()->id),
        ]);
    }
    public function markNotification(Request $request){
        $notificationId = $request->input('id');
        if ($notificationId) {
            $notification = auth()->user()->unreadNotifications->where('id', $notificationId)->first();
            if ($notification) {
                $notification->markAsRead();
                return redirect()->back()->with('success', 'Notification marked as read successfully.');
            } else {
                return redirect()->back()->with('error', 'Notification not found.');
            }
        } else {
            auth()->user()->unreadNotifications->markAsRead();
            return redirect()->back()->with('success', 'All notifications marked as read successfully.');
        }
        return redirect()->back();
    }
}
