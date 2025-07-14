<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'writer') {
                return redirect()->route('writer.dashboard');
            }
        }

        return redirect()->back()->with('error', 'بيانات الدخول غير صحيحة');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}

