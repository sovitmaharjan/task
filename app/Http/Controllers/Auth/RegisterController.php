<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $userInstance = new UserService();
        $user = $userInstance->create($request->validated());
        dd($user);
        // User::create($request->validated());
        return redirect()->route('login')->with('success', 'User created successfully');
    }
}
