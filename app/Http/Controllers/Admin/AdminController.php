<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.index', compact('admin'));
    }

    public function getAdmin()
    {
        return Auth::guard('admin')->user();
    }
}
