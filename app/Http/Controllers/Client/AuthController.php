<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AuthController extends ClientController
{
    public function login () {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.login',
            'title' => 'Login',
            'content' => '',
            'menu' => $this->menu,
        ]);
    }


    public function signupPost (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'username' => 'required|alpha_dash|max:10',
            'email' => 'required|email|unique:users|max:30',
            'password' => 'required|max:10|min:6',
            'password2' => 'required|same:password',
            'isConfirmed' => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect(route('client.auth.login') . '?#signup')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'role_id' => Role::where('name', config('blog.user.role'))->first()->id,
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'created_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
        ]);

        Auth::login($user, true);

        return redirect()->route('client.client.index');

    }

    public function loginPost (Request $request) {


        //  check what field user are using for login and add it to request with appropriate key
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('login')]);

        //  check if we need to remember user
        $remember = $request->input('remember') ? true : false;

        //  try to authenticate user
        $authResult = Auth::attempt($request->only($field, 'password'), $remember);

        if ($authResult) {
            return redirect()->intended(route('client.client.index'));
        } else {
            return redirect()->route('client.auth.login')
                ->with('authError', trans('custom.wrongPassword'));
        }
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('client.client.index');
    }

    /*
     * Authentication with social media account
     *      - redirect to provider site
     *      - handle response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if(Input::get('error') == 'access_denied'){
            return redirect()->route('client.auth.login')
                ->with('msg', trans('auth.providers.failed'));
        }

        $socialUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(['email' => $socialUser->getEmail()],[
            'username' => ($socialUser->getNickname()) ?? strtolower(str_replace(' ', '.', $socialUser->getName())),
            'role_id' => Role::where('name', config('blog.user.role'))->first()->id,
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => $provider . '-' . $socialUser->getId(),
        ]);

        Auth::login($user, true);

        return redirect()->route('client.client.index');
    }
}
