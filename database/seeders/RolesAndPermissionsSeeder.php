<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'manage-prices',
            'publish-prices',
            'manage-highlights',
            'manage-homepage-settings',
            'manage-news-events',
            'manage-programmes',
            'manage-resources',
            'manage-media',
            'view-forms-inbox',
            'view-grievance-reports',
            'manage-users',
            'view-audit-log',
            'manage-site-settings',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // 1. Administrator
        $adminRole = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        // 2. Communications editor
        $commsRole = Role::firstOrCreate(['name' => 'Communications editor', 'guard_name' => 'web']);
        $commsRole->syncPermissions([
            'manage-prices',
            'publish-prices',
            'manage-highlights',
            'manage-homepage-settings',
            'manage-news-events',
            'manage-programmes',
            'manage-resources',
            'manage-media',
            'view-forms-inbox',
        ]);

        // 3. Price editor
        $priceRole = Role::firstOrCreate(['name' => 'Price editor', 'guard_name' => 'web']);
        $priceRole->syncPermissions([
            'manage-prices',
            'publish-prices',
        ]);

        // Assign Administrator role to existing admin users
        $adminUsers = User::where('role', 'admin')
            ->orWhere('username', 'admin')
            ->orWhere('email', 'like', '%admin%')
            ->orWhere('email', 'franklin.okoth@pakpro.co.ke')
            ->get();

        foreach ($adminUsers as $user) {
            $user->assignRole($adminRole);
        }

        // Ensure Franklin Okoth and admin have Administrator role
        $franklin = User::where('email', 'franklin.okoth@pakpro.co.ke')->first();
        if ($franklin) {
            $franklin->name = 'Franklin Okoth';
            $franklin->is_active = true;
            $franklin->save();
            $franklin->assignRole($adminRole);
        }

        $admin = User::where('username', 'admin')->first();
        if ($admin) {
            $admin->name = 'System Administrator';
            $admin->is_active = true;
            $admin->save();
            $admin->assignRole($adminRole);
        }
    }
}

