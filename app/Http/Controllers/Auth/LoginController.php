<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return auth()->user() ? redirect()->route('dashboard') : view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back();
        }
        return redirect()->route('dashboard')->with('success', 'Login successful');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('login')->with('success', 'Logout successful');
    }
}
