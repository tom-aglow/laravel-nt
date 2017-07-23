<?php


namespace App\Classes;

use Laravel\Socialite\Contracts\User as SocialUser;
use App\Models\User;
use App\Models\SocialAccount;
use App\Models\Role;

class SocialAccountLogin
{
    public function createOrGetUser ($provider, SocialUser $socialUser) {

        //TODO delete later + migration + model

//        $hasSocialAccount = (boolean) SocialAccount::where('provider_user_id', $socialUser->getId())
//            ->where('provider', $provider)
//            ->first();
//
//        if (!$hasSocialAccount) {
//            $username = ($socialUser->getNickname()) ?? strtolower(str_replace(' ', '.', $socialUser->getName()));
//
//            dump($username);
//
//            $user = User::create([
//                'username' => $username,
//                'role_id' => Role::where('name', config('blog.user.role'))->first()->id,
//                'name' => $socialUser->getName(),
//                'email' => $socialUser->getEmail(),
//                'password' => $provider . '-' . $socialUser->getId(),
//            ]);
//
//            $socialAccount = SocialAccount::create([
//                'user_id' => $user->id,
//                'provider' => $provider,
//                'provider_user_id' => $socialUser->getId(),
//            ]);
//
//            return $user;
//        } else {
//            echo 'Have account';
//        }
    }
}