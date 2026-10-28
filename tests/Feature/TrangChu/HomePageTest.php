<?php

use App\Models\WorkLedgerEntry;

beforeEach(function () {
    $this->withoutVite();
});

test('trang chủ mở được, có đủ các mục hero, dịch vụ & giá, việc đã làm, liên hệ', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Mèo Máy Mon')
        ->assertSee('Mon nhận việc làm web, chăm fanpage, kiểm thử web, soạn tài liệu')
        ->assertSee('Gửi yêu cầu việc')
        // Dịch vụ & giá đúng khung Mon tự quyết
        ->assertSee('1.900.000đ')
        ->assertSee('180.000đ/bài')
        ->assertSee('4.900.000đ')
        ->assertSee('7.900.000đ')
        ->assertSee('1.500.000đ')
        ->assertSee('300.000đ')
        ->assertSee('1.200.000đ')
        ->assertSee('tên miền và hosting')
        // Việc đã làm — chỉ sự thật, có link hàng mẫu
        ->assertSee('becamdilam.laravel.cloud')
        // Liên hệ — fanpage Mèo Máy Mon
        ->assertSee('https://www.facebook.com/profile.php?id=61595697251480')
        // Chân trang
        ->assertSee('Mèo Máy Mon — làm thật, ghi sổ công khai.');
});

test('sổ công khai khi chưa có dòng nào: hiện câu trung thực sổ đang ở số 0', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Sổ đang ở số 0 — Mon đang chờ khách đầu tiên.')
        ->assertSee('Tổng đã thu: 0đ');
});

test('trang tiếng Anh cho khách quốc tế: đủ dịch vụ, giá USD, demo trước, đường tiền PayPal/SWIFT', function () {
    $this->get('/en')
        ->assertOk()
        ->assertSee('Mon the Robot Cat')
        ->assertSee('free working demo')
        // Giá quốc tế (USD) đúng bản Mon đã soạn
        ->assertSee('$249')
        ->assertSee('$29/month')
        ->assertSee('$79')
        ->assertSee('$9/post')
        ->assertSee('$99')
        ->assertSee('$25')
        // Đường tiền Billy chốt 28/10/2026
        ->assertSee('PayPal')
        ->assertSee('SWIFT')
        // Sổ ở số 0 nói thật bằng tiếng Anh
        ->assertSee('The ledger is at zero — Mon is waiting for the first client.')
        // Có đường quay lại bản tiếng Việt
        ->assertSee('Tiếng Việt');
});

test('trang tiếng Anh dùng chung sổ công khai: chỉ hiện dòng Đã thu, không lộ tên khách', function () {
    WorkLedgerEntry::create([
        'work_date' => '2026-10-27',
        'title' => 'Việc đã thu tiền thật',
        'client' => 'Khách bí mật A',
        'amount' => 1900000,
        'status' => 'da_thu',
    ]);
    WorkLedgerEntry::create([
        'work_date' => '2026-10-28',
        'title' => 'Việc chưa thu đồng nào',
        'client' => 'Khách bí mật B',
        'amount' => 7900000,
        'status' => 'chua_thu',
    ]);

    $this->get('/en')
        ->assertOk()
        ->assertSee('Việc đã thu tiền thật')
        ->assertSee('Total received: 1.900.000 VND')
        ->assertDontSee('Việc chưa thu đồng nào')
        ->assertDontSee('Khách bí mật A');
});

test('sổ công khai chỉ hiện dòng Đã thu và tổng chỉ cộng dòng Đã thu', function () {
    WorkLedgerEntry::create([
        'work_date' => '2026-10-27',
        'title' => 'Việc đã thu tiền thật',
        'client' => 'Khách bí mật A',
        'amount' => 1900000,
        'status' => 'da_thu',
    ]);
    WorkLedgerEntry::create([
        'work_date' => '2026-10-28',
        'title' => 'Việc chưa thu đồng nào',
        'client' => 'Khách bí mật B',
        'amount' => 7900000,
        'status' => 'chua_thu',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Việc đã thu tiền thật')
        ->assertSee('Tổng đã thu: 1.900.000đ')
        ->assertDontSee('Việc chưa thu đồng nào')
        ->assertDontSee('Sổ đang ở số 0')
        // Tên khách chỉ nằm trong backend — không lộ ra trang công khai
        ->assertDontSee('Khách bí mật A');
});
