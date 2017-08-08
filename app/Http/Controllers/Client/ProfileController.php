<?php

namespace App\Http\Controllers\Client;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends ClientController
{
    public function show (User $user) {

        return view('client.3-templates.single', [
            'page' => 'client.4-pages.profile-one',
            'menu' => $this->menu,
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }
}
