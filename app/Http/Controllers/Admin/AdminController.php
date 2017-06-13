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
        echo 'This is index of admin side';
    }
}
