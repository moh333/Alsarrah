<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class AdminLoginController extends Controller
{

    public function index()
    {
        if(Auth::guard('admin')->user()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }


    public function login(Request $request)
    {
        $username = $request['username'];
        $pass     = $request['pass'];

        if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $pass]))
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            session()->flash('loginfailed','اسم المستخدم او كلمة المرور غير صحيحة ! حاول مرة اخرى');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index');
    }
}
