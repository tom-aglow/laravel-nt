<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $pageTitle = '';
    protected $pageContent = '';
    protected $pageMenuActive = [];
    protected $isLoggedIn = false;


    public function index () {
        return view('admin.3-pages.home', [
            'title' => 'Admin index',
            'msg' => '',
        ]);
    }
}
