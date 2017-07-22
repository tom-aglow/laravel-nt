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

    public function login () {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.login',
            'title' => 'Login',
            'content' => '',
            'activeMenu' => 'login',
        ]);
    }

    public function loginPost (Request $request) {

        $remember = $request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'username' => $request->input('login'),
            'password' => $request->input('password')
        ], $remember);

        if ($authResult) {
            return redirect()->route('client.client.index');
        } else {
            return redirect()->route('client.auth.login')
                ->with('authError', trans('custom.wrongPassword'));
        }
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('client.client.index');
    }

}
