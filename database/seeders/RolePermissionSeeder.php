<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa cache quyền
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ===== Tạo Permissions =====
        // Chỉ gồm quyền khung dùng chung. Quyền nghiệp vụ do từng dự án tự khai
        // thêm trong seeder của dự án đó.
        $permissions = [
            // User
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role & Permission
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ===== Tạo Roles =====
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Admin có tất cả quyền
        $adminRole->syncPermissions(Permission::all());

        // Manager xem được người dùng và phân quyền
        $managerRole->syncPermissions([
            'user.view',
            'role.view',
        ]);

        // Staff chưa gán quyền mẫu — dự án tự khai theo nghiệp vụ
        $staffRole->syncPermissions([]);
    }
}
