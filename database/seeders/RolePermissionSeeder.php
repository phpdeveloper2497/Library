<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            Permission::create(['name' => 'permission:viewAny']),
            Permission::create(['name' => 'permission:view']),
            Permission::create(['name' => 'permission:create']),
            Permission::create(['name' => 'permission:update',]),
            Permission::create(['name' => 'permission:delete']),
            Permission::create(['name' => 'permission:restore']),
        ];

        $userPermissions = [
            Permission::create(['name' => 'user:viewAny',]),
            Permission::create(['name' => 'user:view']),
            Permission::create(['name' => 'user:create']),
            Permission::create(['name' => 'user:update']),
            Permission::create(['name' => 'user:delete']),
            Permission::create(['name' => 'user:restore']),

        ];

        $categoryPermissions = [
            Permission::create(['name' => 'category:viewAny']),
            Permission::create(['name' => 'category:view']),
            Permission::create(['name' => 'category:create']),
            Permission::create(['name' => 'category:update']),
            Permission::create(['name' => 'category:delete']),
            Permission::create(['name' => 'category:restore']),
        ];

        $bookPermissions = [
            Permission::create(['name' => 'book:viewAny',]),
            Permission::create(['name' => 'book:view',]),
            Permission::create(['name' => 'book:create',]),
            Permission::create(['name' => 'book:update']),
            Permission::create(['name' => 'book:delete',]),
        ];

        $clientPermissions = [
            Permission::create(['name' => 'client:viewAny']),
            Permission::create(['name' => 'client:view']),
            Permission::create(['name' => 'client:create']),
            Permission::create(['name' => 'client:delete']),
            Permission::create(['name' => 'client:restore']),
        ];

        $bookingPermissions = [
            Permission::create(['name' => 'booking:viewAny']),
            Permission::create(['name' => 'booking:view']),
            Permission::create(['name' => 'booking:create']),
            Permission::create(['name' => 'booking:delete']),
        ];

        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions($permissions, $categoryPermissions, $bookPermissions, $userPermissions,$clientPermissions,$bookingPermissions);

        $cheif_libraryPermission = Role::create(['name' => 'chief_librarian', 'guard_name' => 'web']);
        $cheif_libraryPermission->syncPermissions($categoryPermissions, $bookPermissions, $clientPermissions,$bookingPermissions);

        $librarian = Role::create(['name' => 'librarian']);
        $librarian->syncPermissions($bookPermissions, $clientPermissions, $bookingPermissions);
    }
}
