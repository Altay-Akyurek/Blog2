<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        $user->roles()->sync($request->roles); // Seçilen rolleri günceller
        return redirect()->back()->with('success', 'Kullanıcı rolleri güncellendi');
    }
}

