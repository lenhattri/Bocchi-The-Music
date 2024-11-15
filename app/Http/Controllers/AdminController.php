<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Hiển thị trang dashboard của admin.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

 
}
