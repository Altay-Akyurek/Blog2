<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use app\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'user']);
    }
}
