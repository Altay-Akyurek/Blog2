<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class RoleController extends Controller
{
    public function assignRole(){
        $user= User::find(1);//id si 1 olan kullanıcı.
        $role=Role::find(2);//id si 2 olan ROl.

        //kullanıcıya rol atama
        $user->roles()->attach($role->id);

        return "Rol Başarılı bir şekilde atandı.";
    }

    public function removeRole()
    {
        $user=User::find(1);
        //kullcanıcının rolleri sadece 1 ve 3 olsun 
        $user->roles()->sync([1,3]);

        return "Roller güncellendi.";
    }
}
