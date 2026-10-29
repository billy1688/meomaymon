<?php

use App\Models\PageViewDay;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->withoutVite();
    $this->seed(RolePermissionSeeder::class);
});

test('mở trang chủ làm tăng bộ đếm lượt xem hôm nay', function () {
    $this->get('/')->assertOk();

    $day = PageViewDay::query()->sole();

    expect($day->total_views)->toBe(1)
        ->and($day->human_views)->toBe(1)
        ->and($day->unique_visitors)->toBe(1);
});

test('cùng một khách mở trang chủ 2 lần trong ngày chỉ tính 1 khách không trùng', function () {
    $this->get('/')->assertOk();
    $this->get('/')->assertOk();

    $day = PageViewDay::query()->sole();

    expect($day->total_views)->toBe(2)
        ->and($day->unique_visitors)->toBe(1);
});

test('user-agent của bot được tính vào lượt bot', function () {
    $this->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
    ])->get('/')->assertOk();

    $day = PageViewDay::query()->sole();

    expect($day->total_views)->toBe(1)
        ->and($day->bot_views)->toBe(1)
        ->and($day->human_views)->toBe(0)
        ->and($day->bot_uniques)->toBe(1);
});

test('trang tiếng Anh /en cũng đếm vào cùng một sổ và hiện tổng lượt ghé', function () {
    $this->get('/en')
        ->assertOk()
        ->assertSee('1 visits');

    $this->get('/')
        ->assertOk()
        ->assertSee('2 lượt ghé thăm');

    $day = PageViewDay::query()->sole();

    expect($day->total_views)->toBe(2)
        ->and($day->unique_visitors)->toBe(1);
});

test('dashboard hiện thẻ lưu lượng trang chủ cho người đã đăng nhập', function () {
    $this->get('/')->assertOk();
    $this->withHeaders(['User-Agent' => 'Googlebot/2.1'])->get('/')->assertOk();

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Lưu lượng trang chủ')
        ->assertSee('Lượt xem hôm nay (tổng)')
        ->assertSee('Khách hôm nay (không trùng)')
        ->assertSee('Toàn thời gian (từ trước tới nay)');
});
