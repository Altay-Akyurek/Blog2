<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use function PHPUnit\Framework\returnArgument;
use App\Models\User;
use App\Models\Role;


class ProfileController extends Controller
{
  
    public function showProfile()
    {
        $user=auth()->user()->load('roles.permissions');

        return view('profile',compact('user'));
    }
    public function updateRoles(Request $request)
        {
        // Sadece adminler erişebilir
            if (!auth()->user()->hasRole('admin')) {
                abort(403, 'Yetkiniz yok!');
            }

            foreach ($request->roles as $userId => $roleIds) {
                $user = \App\Models\User::find($userId);
                if ($user) {
                    $user->roles()->sync($roleIds); // Roller güncellenir
                }
            }

            return redirect()->back()->with('status', 'roles-updated');
        }
    public function edit()
    {
        $user = auth()->user()->load('roles.permissions'); // roller ve yetkiler birlikte geliyor
        $allRoles = Role::all(); // admin paneli için tüm roller
        $allUsers = User::with('roles')->get(); // admin paneli için tüm kullanıcılar

        return view('profile.edit', compact('user', 'allRoles', 'allUsers'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       $user=$request->user();
       $request->validate([
        'name'      =>'required|string|max:255',
        'email'     =>'required|email|max:255',
        'bio'       =>'nullable|string|max:500',
        'avatar'    =>'nullable|image|max:2048',
       ]);
       //kullanıcı bilgilerini güncelle
       $user->fill($request->only(['name','email']));

       if($user->isDirty('email')){
        $user->email_verified_at=null;
       }

       $user->save();
       //Profil bilgilerimni oluştur veya güncelle.
       $profile=$user->profile ?? new \App\Models\Profile();
       $profile->user_id=$user->id;
       $profile->bio= $request->bio;

       //avatar yükle 
       if($request->hasFile('avatar')){
        $avatarPath=$request->file('avatar')->store('avatars','public');
        $profile->avatar=$avatarPath;
       }
       $profile->save();
       return redirect()->route('profile.edit')->with('status','profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
