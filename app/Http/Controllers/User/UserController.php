<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userDashboard()
    {
        $data = auth()->user()->toArray();
        return view('user.dashboard',
        compact('data'));
    }

    public function userAccount()
     {
        $data = auth()->user()->toArray();
        return view('user.accountInfo', compact('data'));
    }
    private function getAuthData(){
        $data['name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;
        $data['details'] = auth()->user()->details;
        $data['avatar'] = auth()->user()->avatar_path;
        $data['public_link'] = auth()->user()->public_link;
        return $data;
    }
    public function notificationRead($notification_id)
    {
        if (!empty($notification_id)) {
            $notifications =  app('auth')->guard()->user()->unreadNotifications->where('id', $notification_id)->markAsRead();
        }
        echo "Notification " . $notification_id." read done";
    }
    
    
}
