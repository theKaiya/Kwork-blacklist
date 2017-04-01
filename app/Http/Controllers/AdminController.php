<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Show a admin page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll ()
    {
        return view('admin.list');
    }
}
