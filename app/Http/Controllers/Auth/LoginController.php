<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/home';
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.login',
            'title' => 'Login',
            'content' => '',
            'activeMenu' => 'login',
        ]);
    }

    public function login(Request $request) {
        $remember = $request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $remember);

        if ($authResult) {
            return redirect()->route('client.client.index');
        } else {
            return redirect()->route('client.auth.login')
                ->with('authError', trans('custom.wrongPassword'));
        }
    }
}
