<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole=Role::where('name','admin')->first();
        $editorRole=Role::where('name','editor')->first();
        //adimin yetkileri
        Permission::create(['name'=>'manage_users','role_id'=>$adminRole->id]);
        Permission::create(['name'=>'delete_posts','role_id'=>$adminRole->id]);
        Permission::create(['name'=>'edit_posts','role_id'=>$adminRole->id]);
        Permission::create(['name'=>'publish_posts','role_id'=>$adminRole->id]);
        
        //editor yetkileri
        Permission::create(['name'=>'edit_posts','role_id'=>$editorRole->id]);
        Permission::create(['name'=>'publish_posts','role_id'=>$editorRole->id]);
    }
}
