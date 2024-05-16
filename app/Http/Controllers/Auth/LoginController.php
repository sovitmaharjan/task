<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back();
        }
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }
}
