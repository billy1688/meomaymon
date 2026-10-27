# Chạy Core Starter bằng Docker

Mặc định Docker chạy Laravel với SQLite, đúng với file `.env` của dự án.

```bash
docker compose up --build
```

Mở `http://localhost:8000`. Vite chạy tại cổng `5173` để hỗ trợ phát triển giao diện.

Tài khoản khởi tạo cho môi trường local:

- Email: `admin@example.com`
- Mật khẩu: `Admin@123456`

Đổi mật khẩu này ngay sau lần đăng nhập đầu tiên. Lệnh Docker tự chạy seed khi
tạo database mới.

## Khi một dự án cần MySQL 8.4

MySQL không chạy mặc định. Bật nó cùng ứng dụng bằng:

```bash
docker compose --profile mysql up --build
```

Sau đó sao chép `.env.mysql.example` thành `.env`, tạo `APP_KEY` và chạy migration.
Không làm bước này nếu dự án tiếp tục dùng SQLite.

## Lệnh thường dùng

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan test
docker compose down
```
