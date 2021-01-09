<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /*
     * GET all notification of users
     */

    public function allNotification() {
        $user = User::find(auth()->id());
        foreach($user->notifications   as $notification) {
            var_dump($notification->type);
        }
    }

    /*
     * get all un Read Notification of users
     */

    public function unReadNotification() {
        $user = User::find(auth()->id());
        foreach($user->notifications   as $notification) {
            var_dump($notification->type);
        }
    }

    /*
     * get all Read Notification of users
     */

    public function readNotification() {
        $user = User::find(auth()->id());
        foreach($user->notifications   as $notification) {
            var_dump($notification->type);
        }
    }
}
