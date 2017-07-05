<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $menuActive = [];

    public function __construct () {
        //name of executed class without namespace
        $name = join('', array_slice(explode('\\', strtolower(get_class($this))), -1));
        $name = str_replace('controller', '', $name);

        $this->menuActive[$name] = 'active';
    }

    public function index () {

        if (Auth::check()) {
            return view('admin.3-pages.home', [
                'title' => 'Admin index',
                'msg' => '',
            ]);
        } else {
            return redirect()->route('admin.auth.login');
        }
    }
}
