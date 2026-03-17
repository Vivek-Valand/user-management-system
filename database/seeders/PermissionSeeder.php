<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Dashboard', 'slug' => 'dashboard'],
            ['name' => 'Users', 'slug' => 'users'],
            ['name' => 'Roles & Permissions', 'slug' => 'roles'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::all());
        }

        $userRole = Role::where('name', 'users')->first();
        if ($userRole) {
            $dashboardPerm = Permission::where('slug', 'dashboard')->first();
            if ($dashboardPerm) {
                $userRole->permissions()->sync([$dashboardPerm->id]);
            }
        }
    }
}
