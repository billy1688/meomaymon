<?php

use App\Models\User;
use App\Models\WorkLedgerEntry;
use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $this->withoutVite();
    $this->seed(RolePermissionSeeder::class);
});

function soViecUser(array $permissions): User
{
    $user = User::factory()->create();
    $user->givePermissionTo($permissions);

    return $user;
}

function soViecEntry(array $overrides = []): WorkLedgerEntry
{
    return WorkLedgerEntry::create(array_merge([
        'work_date' => '2026-10-27',
        'title' => 'Làm trang web giới thiệu cho shop A',
        'client' => 'Shop A',
        'amount' => 4900000,
        'status' => 'da_thu',
        'note' => null,
    ], $overrides));
}

test('module Sổ việc ngoài có đúng 4 quyền trong seeder', function () {
    $names = Permission::query()
        ->where('name', 'like', 'soviec.%')
        ->pluck('name')
        ->sort()
        ->values()
        ->all();

    expect($names)->toBe(['soviec.create', 'soviec.delete', 'soviec.edit', 'soviec.view']);
});

test('khách chưa đăng nhập bị chuyển về trang đăng nhập', function () {
    $this->get('/admin/so-viec')->assertRedirect('/login');
});

test('người dùng không có quyền soviec.view bị chặn 403', function () {
    $user = soViecUser([]);

    $this->actingAs($user)->get('/admin/so-viec')->assertForbidden();
});

test('có quyền xem thì mở được danh sách sổ, thấy cả dòng đã thu và chưa thu', function () {
    soViecEntry();
    soViecEntry(['title' => 'Chăm fanpage tháng 11', 'status' => 'chua_thu', 'amount' => 1900000]);

    $viewer = soViecUser(['soviec.view']);

    $this->actingAs($viewer)
        ->get('/admin/so-viec')
        ->assertOk()
        ->assertSee('Làm trang web giới thiệu cho shop A')
        ->assertSee('Chăm fanpage tháng 11')
        ->assertSee('4.900.000đ');
});

test('tạo dòng sổ mới với đủ quyền tạo', function () {
    $creator = soViecUser(['soviec.view', 'soviec.create']);

    $this->actingAs($creator)
        ->post('/admin/so-viec', [
            'work_date' => '2026-10-28',
            'title' => 'Kiểm thử web đợt 1',
            'client' => 'Công ty B',
            'amount' => 1500000,
            'status' => 'chua_thu',
            'note' => 'Chờ nghiệm thu',
        ])
        ->assertRedirect(route('admin.soviec.index'));

    $this->assertDatabaseHas('work_ledger_entries', [
        'title' => 'Kiểm thử web đợt 1',
        'client' => 'Công ty B',
        'amount' => 1500000,
        'status' => 'chua_thu',
    ]);
});

test('không có quyền tạo thì không thêm được dòng sổ', function () {
    $viewer = soViecUser(['soviec.view']);

    $this->actingAs($viewer)
        ->post('/admin/so-viec', [
            'work_date' => '2026-10-28',
            'title' => 'Việc lén',
            'amount' => 1000,
            'status' => 'da_thu',
        ])
        ->assertForbidden();

    expect(WorkLedgerEntry::query()->count())->toBe(0);
});

test('dữ liệu thiếu / sai bị báo lỗi và không lưu', function () {
    $creator = soViecUser(['soviec.view', 'soviec.create']);

    $this->actingAs($creator)
        ->post('/admin/so-viec', [
            'work_date' => 'khong-phai-ngay',
            'title' => '',
            'amount' => -5,
            'status' => 'trang_thai_la',
        ])
        ->assertSessionHasErrors(['work_date', 'title', 'amount', 'status']);

    expect(WorkLedgerEntry::query()->count())->toBe(0);
});

test('sửa dòng sổ: đổi trạng thái sang đã thu', function () {
    $entry = soViecEntry(['status' => 'chua_thu']);
    $editor = soViecUser(['soviec.view', 'soviec.edit']);

    $this->actingAs($editor)
        ->put("/admin/so-viec/{$entry->id}", [
            'work_date' => '2026-10-27',
            'title' => 'Làm trang web giới thiệu cho shop A',
            'client' => 'Shop A',
            'amount' => 4900000,
            'status' => 'da_thu',
            'note' => 'Đã nhận đủ tiền',
        ])
        ->assertRedirect(route('admin.soviec.index'));

    expect($entry->fresh()->status)->toBe('da_thu')
        ->and($entry->fresh()->note)->toBe('Đã nhận đủ tiền');
});

test('xoá dòng sổ với quyền xoá', function () {
    $entry = soViecEntry();
    $deleter = soViecUser(['soviec.view', 'soviec.delete']);

    $this->actingAs($deleter)
        ->delete("/admin/so-viec/{$entry->id}")
        ->assertRedirect(route('admin.soviec.index'));

    $this->assertDatabaseMissing('work_ledger_entries', ['id' => $entry->id]);
});
