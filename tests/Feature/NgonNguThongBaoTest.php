<?php

use App\Models\User;

/**
 * Quy chuẩn ngôn ngữ của core: locale mặc định là tiếng Việt nên mọi thông
 * báo của khung (đăng nhập, validation, phân trang, đặt lại mật khẩu, chuỗi
 * giao diện Breeze trong lang/vi.json) phải hiển thị tiếng Việt. Dự án đúc
 * từ core thừa hưởng nguyên bộ lang/vi này, không dịch lại thông báo khung.
 */
test('locale mặc định của ứng dụng là tiếng Việt và các thông báo khung đã dịch', function () {
    expect(config('app.locale'))->toBe('vi')
        ->and(app()->getLocale())->toBe('vi')
        ->and(__('auth.failed'))->toBe('Thông tin đăng nhập không chính xác.')
        ->and(__('auth.throttle', ['seconds' => 30]))->toBe('Quá nhiều lần đăng nhập thất bại. Vui lòng thử lại sau 30 giây.')
        ->and(__('passwords.user'))->toBe('Không tìm thấy tài khoản nào với địa chỉ email này.')
        ->and(__('pagination.next'))->toBe('Tiếp &raquo;')
        ->and(__('Save'))->toBe('Lưu')
        ->and(__('Log Out'))->toBe('Đăng xuất');
});

test('đăng nhập sai mật khẩu: hiển thị thông báo tiếng Việt từ auth.failed', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'mat-khau-sai',
    ]);

    $response->assertSessionHasErrors([
        'email' => 'Thông tin đăng nhập không chính xác.',
    ]);
    $this->assertGuest();
});

test('form đăng ký hiển thị dòng hướng dẫn quy tắc mật khẩu dưới ô mật khẩu', function () {
    $this->get('/register')
        ->assertOk()
        ->assertSee('Mật khẩu ít nhất 12 ký tự, gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt (ví dụ: Abc@12345678).');
});

test('form đặt lại mật khẩu hiển thị dòng hướng dẫn quy tắc mật khẩu dưới ô mật khẩu', function () {
    $this->get(route('password.reset', ['token' => 'token-thu']))
        ->assertOk()
        ->assertSee('Mật khẩu ít nhất 12 ký tự, gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt (ví dụ: Abc@12345678).');
});

test('form đổi mật khẩu trong hồ sơ hiển thị dòng hướng dẫn quy tắc mật khẩu dưới ô mật khẩu mới', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/profile')
        ->assertOk()
        ->assertSee('Mật khẩu ít nhất 12 ký tự, gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt (ví dụ: Abc@12345678).');
});

test('đăng ký sai dữ liệu: lỗi validation hiển thị tiếng Việt kèm tên trường thân thiện', function () {
    $response = $this->post('/register', [
        'name' => '',
        'email' => 'khong-phai-email',
        'password' => 'ngan',
        'password_confirmation' => 'khac-nhau',
    ]);

    $response->assertSessionHasErrors([
        'name' => 'Trường họ tên là bắt buộc.',
        'email' => 'Trường địa chỉ email phải là một địa chỉ email hợp lệ.',
        'password' => 'Giá trị xác nhận của trường mật khẩu không khớp.',
    ]);
    $this->assertGuest();
});
