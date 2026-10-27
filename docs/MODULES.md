# Quy ước tổ chức chức năng trong Laravel Core Starter

Core Starter sử dụng **cấu trúc chuẩn của Laravel**. Không tạo `app/Modules/<TenModule>` hoặc một cây thư mục module riêng.

Mỗi nhóm nghiệp vụ được phân loại ngay bên trong các thư mục chuẩn của Laravel:

```text
app/Http/Controllers/Sourcing/   # Controller của Tìm nguồn cung
app/Models/                      # Model dùng chung theo chuẩn Laravel
resources/views/sourcing/        # Blade của Tìm nguồn cung
routes/sourcing.php              # Route của Tìm nguồn cung
database/migrations/             # Migration dùng chung
database/seeders/                # Seeder dùng chung
tests/Feature/Sourcing/          # Feature tests
```

`routes/web.php` chỉ nạp route chức năng:

```php
require __DIR__.'/sourcing.php';
```

Các chức năng khác áp dụng cùng nguyên tắc, ví dụ:

```text
app/Http/Controllers/Purchasing/
resources/views/purchasing/
routes/purchasing.php

app/Http/Controllers/Inventory/
resources/views/inventory/
routes/inventory.php
```

Không tạo ServiceProvider chỉ để nạp route/view cho từng chức năng. View sử dụng namespace Laravel thông thường, ví dụ `view('sourcing.products.index')`.

## Các module nghiệp vụ của dự án meomaymon

Áp đúng quy ước trên, dự án có 2 module nghiệp vụ (đặc tả chi tiết trong `docs/modules/`):

| Module | Controller | View | Route | Quyền | Đặc tả |
|---|---|---|---|---|---|
| Sổ việc ngoài | `app/Http/Controllers/SoViec/` | `resources/views/soviec/` | `routes/soviec.php` | `soviec.*` | [docs/modules/so-viec-ngoai.md](modules/so-viec-ngoai.md) |
| Yêu cầu việc | `app/Http/Controllers/YeuCau/` | `resources/views/yeucau/` | `routes/yeucau.php` | `yeucau.*` | [docs/modules/yeu-cau-viec.md](modules/yeu-cau-viec.md) |
| Trang chủ công khai | `app/Http/Controllers/TrangChu/` | `resources/views/trangchu/` | trong `routes/web.php` | công khai (không đăng nhập) | — |

Mỗi module có đúng 4 quyền xem / tạo / sửa / xoá, khai trong `database/seeders/RolePermissionSeeder.php`.
