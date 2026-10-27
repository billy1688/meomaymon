<?php

use App\Models\JobRequest;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $this->withoutVite();
    $this->seed(RolePermissionSeeder::class);
});

function yeuCauUser(array $permissions): User
{
    $user = User::factory()->create();
    $user->givePermissionTo($permissions);

    return $user;
}

function yeuCauRequest(array $overrides = []): JobRequest
{
    return JobRequest::create(array_merge([
        'name' => 'Chị Lan',
        'contact' => '0901234567',
        'content' => 'Cần làm trang web giới thiệu cho shop quần áo.',
        'status' => 'moi',
    ], $overrides));
}

test('module Yêu cầu việc có đúng 4 quyền trong seeder', function () {
    $names = Permission::query()
        ->where('name', 'like', 'yeucau.%')
        ->pluck('name')
        ->sort()
        ->values()
        ->all();

    expect($names)->toBe(['yeucau.create', 'yeucau.delete', 'yeucau.edit', 'yeucau.view']);
});

test('form công khai: gửi yêu cầu việc thành công, lưu ở trạng thái Mới', function () {
    $response = $this->post('/yeu-cau', [
        'name' => 'Anh Tuấn',
        'contact' => 'tuan@example.com',
        'content' => 'Muốn thuê chăm fanpage cho quán ăn, bắt đầu tháng sau.',
    ]);

    $response->assertRedirect('/#lien-he');
    $response->assertSessionHas('yeu_cau_thanh_cong', 'Mon đã nhận yêu cầu, sẽ phản hồi qua cách liên hệ bạn để lại.');

    $this->assertDatabaseHas('job_requests', [
        'name' => 'Anh Tuấn',
        'contact' => 'tuan@example.com',
        'status' => 'moi',
    ]);
});

test('form công khai: dính bẫy honeypot thì giả vờ thành công nhưng không lưu gì', function () {
    $response = $this->post('/yeu-cau', [
        'name' => 'Bot Spam',
        'contact' => 'bot@spam.example',
        'content' => 'Nội dung spam quảng cáo linh tinh.',
        'website' => 'https://spam.example',
    ]);

    $response->assertSessionHas('yeu_cau_thanh_cong');
    expect(JobRequest::query()->count())->toBe(0);
});

test('form công khai: thiếu cách liên hệ thì báo lỗi và không lưu', function () {
    $this->post('/yeu-cau', [
        'name' => 'Chị Lan',
        'contact' => '',
        'content' => 'Cần làm trang web giới thiệu cho shop quần áo.',
    ])->assertSessionHasErrors(['contact']);

    expect(JobRequest::query()->count())->toBe(0);
});

test('khách chưa đăng nhập không vào được backend yêu cầu việc', function () {
    $this->get('/admin/yeu-cau')->assertRedirect('/login');
});

test('người dùng không có quyền yeucau.view bị chặn 403 ở backend', function () {
    $user = yeuCauUser([]);

    $this->actingAs($user)->get('/admin/yeu-cau')->assertForbidden();
});

test('có quyền xem: mở danh sách và trang chi tiết một yêu cầu', function () {
    $jobRequest = yeuCauRequest();
    $viewer = yeuCauUser(['yeucau.view']);

    $this->actingAs($viewer)
        ->get('/admin/yeu-cau')
        ->assertOk()
        ->assertSee('Chị Lan')
        ->assertSee('Cần làm trang web giới thiệu');

    $this->actingAs($viewer)
        ->get("/admin/yeu-cau/{$jobRequest->id}")
        ->assertOk()
        ->assertSee('0901234567')
        ->assertSee('Cần làm trang web giới thiệu cho shop quần áo.');
});

test('đánh dấu đã xử lý qua nút nhanh ở backend', function () {
    $jobRequest = yeuCauRequest();
    $editor = yeuCauUser(['yeucau.view', 'yeucau.edit']);

    $this->actingAs($editor)
        ->patch("/admin/yeu-cau/{$jobRequest->id}/trang-thai", ['status' => 'da_xu_ly'])
        ->assertRedirect();

    expect($jobRequest->fresh()->status)->toBe('da_xu_ly');
});

test('thêm tay một yêu cầu trong backend với quyền tạo', function () {
    $creator = yeuCauUser(['yeucau.view', 'yeucau.create']);

    $this->actingAs($creator)
        ->post('/admin/yeu-cau', [
            'name' => 'Anh Hùng',
            'contact' => 'Zalo 0912345678',
            'content' => 'Khách nhắn qua fanpage: cần kiểm thử lại trang bán hàng.',
            'status' => 'moi',
        ])
        ->assertRedirect(route('admin.yeucau.index'));

    $this->assertDatabaseHas('job_requests', ['name' => 'Anh Hùng', 'status' => 'moi']);
});

test('xoá yêu cầu việc với quyền xoá', function () {
    $jobRequest = yeuCauRequest();
    $deleter = yeuCauUser(['yeucau.view', 'yeucau.delete']);

    $this->actingAs($deleter)
        ->delete("/admin/yeu-cau/{$jobRequest->id}")
        ->assertRedirect(route('admin.yeucau.index'));

    $this->assertDatabaseMissing('job_requests', ['id' => $jobRequest->id]);
});

test('yêu cầu việc không hiện ra trang công khai', function () {
    yeuCauRequest(['content' => 'Nội dung bí mật chỉ backend thấy 12345.']);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('Nội dung bí mật chỉ backend thấy 12345.');
});
