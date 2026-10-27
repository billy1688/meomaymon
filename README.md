# Laravel Core Starter

Khuôn đúc hệ thống Laravel mới: khung dùng chung đã dựng sẵn để một dự án mới bắt đầu từ vạch xuất phát có đăng nhập, phân quyền và kỷ luật code — thay vì dựng lại từ đầu. Quy ước bất biến của khuôn nằm ở [AGENTS.md](AGENTS.md); tài liệu tổ chức chức năng ở [docs/MODULES.md](docs/MODULES.md).

## Core gồm những gì

- **Khung:** PHP 8.3 · Laravel 13 · Livewire 4 · Vite 8.
- **Giao diện:** Tailwind 4 + Bootstrap 5.3.8 (tải qua Sass ở `resources/scss/bootstrap.scss`) — màn hình quản trị dùng Bootstrap 5, Tailwind hỗ trợ các tiện ích bố cục.
- **Tài khoản:** đăng nhập/đăng ký/quên mật khẩu (Laravel Breeze), hồ sơ cá nhân.
- **Phân quyền:** spatie/laravel-permission — sẵn 3 vai `admin` / `manager` / `staff`, bộ quyền khung `user.*`, `role.*`, màn hình quản trị User/Role/Permission ở `/admin`.
- **Kỷ luật code:** Pint (định dạng), PHPStan level 7, Pest (test), GitHub Actions CI, Dependabot.
- **Chạy local bằng Docker:** xem [docs/DOCKER.md](docs/DOCKER.md).

## Bắt đầu một dự án mới từ khuôn này

1. Tạo repo mới từ template này (nút **Use this template** trên GitHub), clone về máy.
2. Cài đặt: `composer setup` (cài thư viện, tạo `.env`, sinh khoá, chạy migration, build giao diện).
3. Chạy thử: `composer dev` rồi mở trang đăng nhập.
4. Tài khoản admin khởi tạo (chỉ cho môi trường local): `admin@example.com` / `Admin@123456` — **đổi mật khẩu ngay khi đưa lên môi trường thật, và không bao giờ để tài khoản này tồn tại ở bản chạy thật với mật khẩu mặc định.**
5. Viết chức năng đầu tiên theo đúng mẫu cấu trúc thư mục trong AGENTS.md, khai thêm quyền nghiệp vụ trong seeder của dự án.

## Kiểm tra trước khi bàn giao

```bash
composer test
```

Lệnh này chạy lần lượt: Pint (kiểm tra định dạng), PHPStan (kiểu dữ liệu) và Pest (toàn bộ test). Cả ba phải xanh.
