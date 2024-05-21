<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        $data['users'] = $this->userService->fetchAll();
        return view('user.index', $data)->with('success', 'Users.');
    }
}
