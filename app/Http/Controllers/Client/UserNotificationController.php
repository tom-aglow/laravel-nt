<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;

class UserNotificationController extends ClientController
{

    public function __construct () {
        $this->middleware('auth');
    }

    public function index (User $user) {
        return auth()->user()->unreadNotifications;
    }

    public function destroy (User $user, $notificationId) {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
