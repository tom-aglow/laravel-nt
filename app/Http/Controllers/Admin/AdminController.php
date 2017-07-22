<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * Custom paginator
     */
    protected function paginate($col, $perPage = 10, $path)
    {
        //  Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //  Slice the collection to get the items to display in current page
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();

        //  Create paginator and pass it to the view
        return new LengthAwarePaginator($currentPageItems, count($col), $perPage, $currentPage, [
            'path' => $path
        ]);
    }
}
