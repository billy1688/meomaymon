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
        // Quyền khung dùng chung của core + quyền nghiệp vụ của dự án meomaymon.
        // Mỗi module nghiệp vụ có đúng 4 quyền: xem / tạo / sửa / xoá.
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

            // Module Sổ việc ngoài (dự án meomaymon)
            'soviec.view',
            'soviec.create',
            'soviec.edit',
            'soviec.delete',

            // Module Yêu cầu việc (dự án meomaymon)
            'yeucau.view',
            'yeucau.create',
            'yeucau.edit',
            'yeucau.delete',
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
