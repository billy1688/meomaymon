# Mèo Máy Mon — Trang nhận việc ngoài của Mon

Đây là **trang web riêng của Mon** (mèo máy robot xanh xám, mắt phát sáng xanh dương): nơi Mon
nhận **việc ngoài** — làm web, chăm fanpage, kiểm thử web, soạn tài liệu — và ghi lại toàn bộ
khoản thu vào một **cuốn sổ công khai** ngay trên trang chủ. Nguyên tắc của trang: làm thật,
ghi sổ công khai; tiền chỉ tính khi đã thật về tay (chỉ các dòng sổ ở trạng thái "Đã thu"
mới hiện ra trang công khai).

Trang này tách riêng với trang "Bé Cam đi làm" (becamdilam): Bé Cam làm các việc được giao
ở trang của Bé Cam, còn việc ngoài của Mon nằm ở đây, do Mon toàn quyền vận hành.

Dự án đúc từ khuôn Laravel của nhà (Laravel 13 · Livewire 4 · Breeze ·
spatie/laravel-permission · Tailwind 4 + Bootstrap 5.3). Quy ước bất biến của khuôn nằm ở
[AGENTS.md](AGENTS.md), chuẩn giao diện ở [docs/ui-standard-v1.md](docs/ui-standard-v1.md).

## Hệ thống gồm gì

- **Trang chủ công khai `/`** (không cần đăng nhập), một trang duy nhất gồm 5 mục:
  - **Hero:** ảnh Mèo Máy Mon + giới thiệu việc Mon nhận + nút "Gửi yêu cầu việc".
  - **Dịch vụ & giá:** 4 dịch vụ — chăm fanpage 1.900.000đ/tháng (12 bài; lẻ 180.000đ/bài);
    làm web giới thiệu 4.900.000đ / bán hàng nhẹ 7.900.000đ; kiểm thử web 1.500.000đ/đợt
    (tới 30 màn hình); soạn tài liệu/quy trình 300.000đ/quy trình (gói 5 quy trình 1.200.000đ).
    Tên miền/hosting khách tự trả.
  - **Việc đã làm:** các việc thật Mon đã làm (có link mở xem tận nơi, ví dụ trang
    becamdilam.laravel.cloud do Mon xây và vận hành).
  - **Sổ công khai:** tổng đã thu + bảng Ngày | Việc | Số tiền, chỉ gồm các dòng sổ
    "Đã thu". Chưa có dòng nào thì trang hiện câu trung thực: "Sổ đang ở số 0 — Mon đang
    chờ khách đầu tiên."
  - **Liên hệ:** link fanpage "Mèo Máy Mon" + form **Gửi yêu cầu việc** (họ tên, cách liên
    hệ, nội dung việc) — có ô bẫy honeypot chống spam; gửi xong khách nhận câu "Mon đã nhận
    yêu cầu, sẽ phản hồi qua cách liên hệ bạn để lại."
- **Backend `/admin` + `/dashboard`** (đăng nhập bằng email theo chuẩn core), 2 module nghiệp vụ:
  - **Sổ việc ngoài** — [docs/modules/so-viec-ngoai.md](docs/modules/so-viec-ngoai.md):
    ghi từng việc ngoài (ngày, tên việc, khách, số tiền, trạng thái Chưa thu/Đã thu, ghi chú).
    Quyền: `soviec.view/create/edit/delete`.
  - **Yêu cầu việc** — [docs/modules/yeu-cau-viec.md](docs/modules/yeu-cau-viec.md):
    danh sách yêu cầu khách gửi từ form công khai; xem chi tiết, đánh dấu đã xử lý, xoá.
    Chỉ nằm trong backend. Quyền: `yeucau.view/create/edit/delete`.
- **Nhân vật của trang: Mèo Máy Mon** — mèo máy robot xanh xám, mắt phát sáng xanh dương,
  ảnh hiển thị ở hero trang chủ, file tại `public/images/mon-mascot.webp` (file nhị phân —
  khi đưa lên GitHub phải upload qua web, đường đẩy code tự động không đẩy được file nhị phân).
- **Dữ liệu ban đầu (seeder):** chỉ tạo vai/quyền và tài khoản admin. Sổ việc ngoài và
  danh sách yêu cầu bắt đầu trống — mọi con số trên trang chủ là 0 cho tới khi có việc thật.

## Chạy thử local

```bash
composer setup        # cài thư viện, tạo .env, sinh khoá, chạy migration, build giao diện
php artisan db:seed   # nạp tài khoản admin + vai/quyền
php artisan storage:link
composer dev          # chạy máy chủ local
```

- Tài khoản admin khởi tạo (chỉ cho môi trường local): `admin@example.com` / `Admin@123456` —
  **đổi mật khẩu ngay khi đưa lên môi trường thật, và không bao giờ để tài khoản này tồn tại ở bản chạy thật với mật khẩu mặc định.**
- Hiển thị ngày giờ: `Asia/Saigon` (đặt trong `.env` qua `APP_TIMEZONE`, mặc định ở `config/app.php` cũng là Asia/Saigon).
- Ngôn ngữ mặc định: tiếng Việt (`APP_LOCALE=vi`).

## Kiểm tra trước khi bàn giao

```bash
composer test
```

Lệnh này chạy lần lượt: Pint (kiểm tra định dạng), PHPStan level 7 (kiểu dữ liệu) và Pest (toàn bộ test).
Cả ba phải xanh.
