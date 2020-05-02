<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view("admin_panel.users.index", compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view("admin_panel.users.edit", compact('user', 'roles'));
    }

    public function update(StoreUserPost $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('user.index')->with('status', 'User updated successfully.');
    }
}
