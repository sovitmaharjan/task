<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->readAll();
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

    public function edit($id)
    {
        $data['user'] = $this->userService->read($id);
        if(!$data['user']){
            return back()->with('error', 'User not found.');
        }
        return view('user.edit', $data);
    }

    public function update($id, UserUpdateRequest $request)
    {
        $data['user'] = $this->userService->read($id);
        if(!$data['user']){
            return back()->with('error', 'User not found.');
        }
        $this->userService->update($id, $request->validated());
        return redirect()->route('user.index')->with('success', 'User has been updated.');
    }

    public function destroy($identifier)
    {
        if (auth()->id() == $identifier) {
            return back()->with('error', 'Can\'t delete current user.');
        }
        $this->userService->delete($identifier);
        return back()->with('success', 'User has been deleted.');
    }
}
