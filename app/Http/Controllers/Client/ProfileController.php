<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends ClientController
{
    public function show (User $user) {

        return view('client.3-templates.single', [
            'page' => 'client.4-pages.profile-one',
            'menu' => $this->menu,
            'profileUser' => $user,
            'activities' => $this->getActivity($user)
        ]);
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    protected function getActivity (User $user) {

        return $user->activities()->latest()->with('subject')->take(50)->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
