<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginAdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
}
