<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegistrationNotification;
use App\Models\Admin;

class DbNotificationServices
{    
    public static function sendUserRegistrationNotification($notificationDetails)
    {
        $admin_user = Admin::first();
        Notification::send($admin_user, new UserRegistrationNotification($notificationDetails));
    }    
}
