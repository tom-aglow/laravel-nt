<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends ClientController
{
    public function signup () {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.signup',
            'title' => 'Sign up',
            'content' => '',
            'activeMenu' => 'signup',
        ]);
    }

    public function signupPost (Request $request) {
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|alpha_dash|max:10',
            'email' => 'required|email|unique:users|max:30',
            'password' => 'required|max:10|min:6',
            'password2' => 'required|same:password',
            'isConfirmed' => 'accepted',
        ]);

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'created_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('client.client.index');

    }


    /*
     *  for login form loading see \Auth\LoginController -> showLoginForm
     */

//    public function login () {

//    }


    /*
     *  for login form posting see \Auth\LoginController -> login
     */

//    public function loginPost (Request $request) {
//
//    }

    public function logout () {
        Auth::logout();
        return redirect()->route('client.client.index');
    }

}
