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

    public function postLogin(Request $request)
    {
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        
        if (Auth::guard('admin')->attempt(['user_name' => $user_name, 'password' => $password])) {
            return redirect()->route('admins.index');
        } else {
            return back()->withInput()->withErrors([
                'errorLogin' => 'Username or password incorrect'
            ]);
        }
    }
}
