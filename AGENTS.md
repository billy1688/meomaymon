# Laravel Core Starter — quy ước tối thiểu

Đây là **khuôn đúc hệ thống Laravel mới**. Core chỉ chứa khung dùng chung (đăng nhập, phân quyền, khung giao diện, công cụ kiểm tra code); **không chứa nghiệp vụ** của bất kỳ hệ thống nào.

File này chỉ ghi phần **bất biến của core**. Tiêu chuẩn riêng của từng dự án nằm tại repo của dự án đó, không nằm ở đây và không lấy từ core này.

## Điểm bất biến: cấu trúc thư mục của một chức năng

Mọi chức năng (module nghiệp vụ) đều tổ chức theo đúng mẫu này, dùng thư mục chuẩn của Laravel — **không tạo cây thư mục module riêng** (không `app/Modules/`, không ServiceProvider riêng cho từng chức năng):

```text
app/Http/Controllers/<ChucNang>/   # Controller của chức năng
app/Models/                        # Model dùng chung
app/Http/Requests/<ChucNang>/      # Kiểm tra dữ liệu nhập (nếu có)
resources/views/<chucnang>/        # Giao diện (Blade)
routes/<chucnang>.php              # Route của chức năng
database/migrations/               # Migration dùng chung
database/seeders/                  # Seeder dùng chung
tests/Feature/<ChucNang>/          # Kiểm thử của chức năng
```

`routes/web.php` chỉ nạp route chức năng bằng một dòng `require` cho mỗi chức năng. Tên thư mục chức năng viết theo cùng một kiểu ở mọi nơi nó xuất hiện.

## Khung cố định của core

- PHP 8.3 · Laravel 13 · Livewire 4 · Tailwind 4 + Bootstrap 5.
- Đăng nhập/đăng ký/quên mật khẩu: Laravel Breeze. Phân quyền: spatie/laravel-permission (vai + quyền, khai báo trong seeder).
- Ngôn ngữ mặc định là tiếng Việt (`vi`): bộ `lang/vi` (auth, validation, pagination, passwords + vi.json) là một phần của core — dự án đúc từ core không tự dịch lại thông báo khung, chỉ bổ sung chuỗi nghiệp vụ riêng tại repo của mình.
- Mật khẩu giữ quy tắc mặc định của skeleton trong `AppServiceProvider` (ở production: tối thiểu 12 ký tự, gồm chữ hoa, chữ thường, chữ số, ký tự đặc biệt và kiểm tra `uncompromised`) — MỌI form đặt mật khẩu mới (đăng ký, đặt lại mật khẩu, đổi mật khẩu trong hồ sơ...) phải hiển thị dòng hướng dẫn yêu cầu này ngay dưới ô nhập mật khẩu.
- Đăng nhập chuẩn của core là bằng **email** (theo Breeze). Đăng nhập bằng username/ID là tuỳ biến riêng của từng dự án có dữ liệu cũ (ví dụ azinalogi), KHÔNG đưa vào core.
- Quy chuẩn giao diện là `docs/ui-standard-v1.md` (Azinalogi UI Standard v1) — một phần của core: giao diện Admin và Khách hàng của dự án đúc từ core tuân theo chuẩn này (màu nút theo ý nghĩa, header trang dùng chung, bảng, form, modal xác nhận xoá). Chuẩn chỉ quy định trình bày, không thay đổi nghiệp vụ.
- Kiểm tra code: Pint (định dạng), PHPStan level 7 (kiểu dữ liệu), Pest (test). Lệnh `composer test` chạy cả ba — phải xanh trước khi bàn giao.

## Ba quy tắc không phá

1. Không commit file `.env` và mọi bí mật (khoá, mật khẩu) — chỉ commit `.env.example`.
2. Mọi thay đổi cấu trúc database đều bằng migration; không sửa tay database rồi bỏ qua.
3. Muốn đổi chính cấu trúc thư mục chức năng ở trên: sửa file này trước, áp dụng cho mọi chức năng sau đó — không tự ý làm khác ở một chức năng riêng lẻ.
