<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $loginRequest = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($loginRequest)) {
            if (Auth::user()->status == 1) {
                flash()->success('Đăng nhập thành công!');
                return redirect()->route('dashboard.index');
            } else {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('auth.admin')->withInput();
            }
        }
        flash()->error('Email hoặc mật khẩu không chính xác.');
        return redirect()->route('auth.admin')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
