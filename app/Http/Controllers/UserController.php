<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\User\UserStoreRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data['users'] = $this->userService->fetchAll();
        return view('user.index', $data)->with('success', 'Users.');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $this->userService->create($request->validated());
        return back()->with('success', 'User has been created.');
    }
}
