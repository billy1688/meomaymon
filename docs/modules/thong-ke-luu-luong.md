# Thống kê lưu lượng trang chủ

Bộ đếm tự ghi trong hệ thống (không gắn dịch vụ ngoài nào), port từ
becamdilam — Billy chốt áp dụng cho trang Mèo Máy Mon ngày 29/10/2026.

## Đếm cái gì

Mỗi lần mở thành công trang chủ — cả bản tiếng Việt (`/`) lẫn bản
tiếng Anh (`/en`), đếm chung một sổ — hệ thống ghi 1 lượt vào ngày
hôm đó (giờ Việt Nam). Định nghĩa "lượt xem" giống bên Bé Cam:

- **Đếm tất cả**: người thường, bot (công cụ của các hãng tìm kiếm,
  mạng xã hội... duyệt web thay mặt chủ nhân của chúng) và cả người
  đã đăng nhập backend (đội nhà). Tổng luôn là tổng thật, không lọc.
- **Tách 3 thành phần** để đọc cho rõ: người thường / bot (nhận diện
  thô qua dòng giới thiệu trình duyệt — user-agent) / đội nhà.
- **Khách không trùng trong ngày**: mỗi khách chỉ tính 1 lần trong
  một ngày, dù mở trang nhiều lần. Khách được nhận diện bằng **bản
  băm** của địa chỉ IP trộn với khoá bí mật của ứng dụng (đội nhà
  thì băm theo mã tài khoản). **Địa chỉ IP thô không bao giờ được
  lưu.**
- Nếu bộ đếm gặp lỗi, trang chủ vẫn mở bình thường — thống kê là
  phụ, không được làm hỏng trang.

## Xem số ở đâu

- **Công khai**: dưới mục Sổ công khai ở trang chủ có dòng nhỏ
  "👁 … lượt ghé thăm" (bản tiếng Anh: "… visits") — chỉ hiện tổng
  lượt xem từ trước tới nay, gồm cả chính lượt đang xem.
- **Backend** (Bảng điều khiển `/dashboard`): thẻ "Lưu lượng trang
  chủ" gồm lượt xem hôm nay (tách người/bot/đội nhà), khách không
  trùng hôm nay, và tổng toàn thời gian (tổng lượt xem + tổng khách
  không trùng cộng dồn theo từng ngày).

## Dữ liệu nằm ở đâu

- Bảng `page_view_days`: một dòng cho mỗi ngày — tổng lượt, lượt
  tách theo 3 thành phần, số khách không trùng.
- Bảng `page_view_visitors`: một dòng cho mỗi (ngày, khách) — chỉ
  giữ bản băm nhận diện, không giữ IP.
- Mã nguồn: `app/Support/PageViewCounter.php`, hai model
  `PageViewDay` / `PageViewVisitor`, migration
  `2026_10_29_000001_create_page_view_tables`.

Đây là hạ tầng nền của trang (giống bên becamdilam), không phải một
module nghiệp vụ: không có quyền riêng, không có màn hình nhập liệu.
