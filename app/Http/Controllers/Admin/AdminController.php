<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    protected $menuActive = [];

    public function __construct () {

        //  get the name of executed class without namespace
        $name = join('', array_slice(explode('\\', strtolower(get_class($this))), -1));
        $name = str_replace('controller', '', $name);

        //  fill array with active menu element
        $this->menuActive[$name] = 'active';
    }


    /**
     * Rendering admin index view
     */
    public function index () {

        if (!Auth::check() || Gate::denies('admin-access')) {
            abort(403);
        } else {
            return view('admin.3-pages.home', [
                'title' => 'Admin index',
                'msg' => '',
            ]);
        }
    }
}
