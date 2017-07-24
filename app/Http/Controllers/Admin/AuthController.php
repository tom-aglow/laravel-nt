<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuthController extends AdminController
{
    public function login() {

        return view('admin.3-pages.login', [
            'title' => 'Login',
            'authError' => session('authError') ?? '',
        ]);
    }


    public function loginPost(Request $request) {

        $remember = $request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ], $remember);

        if ($authResult) {
            return redirect()->intended(route('admin.admin.index'));
            //TODO intended url not working without middleware 'web'
        } else {
            return redirect()->route('admin.auth.login')
                ->with('authError', trans('custom.wrongPassword'));
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('client.client.index');
    }
}
