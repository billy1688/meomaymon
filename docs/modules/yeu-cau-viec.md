# Module Yêu cầu việc

## Module này để làm gì

Đây là hộp thư nhận **yêu cầu việc** của khách. Khách ghé trang chủ, điền form
"Gửi yêu cầu việc" (họ tên, cách liên hệ, nội dung việc) — yêu cầu chạy thẳng vào đây,
ở trạng thái **Mới**, chờ đội nhà xử lý: đọc, liên hệ lại với khách, chốt việc. Khi một
việc đã liên hệ xong và chốt được, đội nhà ghi nó vào **Sổ việc ngoài**; yêu cầu ở đây
chỉ là đầu mối, không phải sổ tiền.

Ví dụ chạy xuyên suốt: chị Lan chủ shop quần áo điền form ở trang chủ — họ tên "Chị Lan",
cách liên hệ "Zalo 0901 234 567", nội dung "Cần một trang web giới thiệu cho shop, đang
bán chủ yếu trên Facebook". Gửi xong chị thấy câu "Mon đã nhận yêu cầu, sẽ phản hồi qua
cách liên hệ bạn để lại." Trong backend xuất hiện một yêu cầu mới của chị Lan, trạng thái
Mới. Mon liên hệ chị qua Zalo, chốt gói web giới thiệu → bấm nút **Đã xử lý** ở yêu cầu
này, rồi qua Sổ việc ngoài ghi dòng việc của chị.

## Ai dùng, ở đâu

- Phần khách thấy: form ở mục **Liên hệ** của trang chủ công khai — ai cũng gửi được,
  không cần đăng nhập.
- Phần quản lý: chỉ trong **khu quản trị**, menu **Yêu cầu việc**. Danh sách yêu cầu
  **không bao giờ** hiện ra trang công khai.
- Quyền: `yeucau.view` (xem danh sách + chi tiết), `yeucau.create` (thêm tay),
  `yeucau.edit` (sửa + đánh dấu đã xử lý), `yeucau.delete` (xoá). Vai admin có đủ 4 quyền.

## Các màn hình và nút bấm

- **Danh sách yêu cầu:** khung xanh phía trên cho biết đang có bao nhiêu yêu cầu **Mới**
  chờ xử lý. Có ô **Lọc theo trạng thái** (Tất cả / Mới / Đã xử lý). Bảng gồm Người gửi ·
  Cách liên hệ · Nội dung việc (rút gọn) · Ngày gửi · Trạng thái · Hành động:
  - Nút **Xem** — mở trang chi tiết đọc toàn bộ nội dung.
  - Nút **Sửa** (màu cam) — mở form sửa.
  - Nút **Đã xử lý** (màu xanh lá, chỉ hiện khi yêu cầu đang Mới) — đánh dấu nhanh đã
    xử lý mà không cần mở form.
  - Nút **Xoá** (viền đỏ) — hiện hộp hỏi lại trước khi xoá thật.
  - Nút **+ Thêm yêu cầu** (góc phải trên) — thêm tay một yêu cầu, ví dụ khách nhắn qua
    fanpage thay vì điền form.
- **Trang chi tiết:** hiện đủ họ tên, cách liên hệ, trạng thái, ngày gửi và toàn văn nội
  dung việc. Có nút **Đánh dấu đã xử lý**; nếu đã xử lý rồi thì có nút **Mở lại (chưa xử
  lý)** để đưa yêu cầu về trạng thái Mới.
- **Form thêm / sửa** gồm 4 ô: Họ tên người gửi · Cách liên hệ · Nội dung việc · Trạng thái.

## Chống spam ở form công khai

- Form có **ô bẫy honeypot** tên "website" mà người thật không nhìn thấy: bot điền bừa
  vào ô này sẽ bị chặn — hệ thống giả vờ nhận thành công nhưng **không lưu gì cả**.
- Mỗi địa chỉ IP chỉ gửi được tối đa **5 yêu cầu trong 10 phút**.
- Yêu cầu gửi vào luôn ở trạng thái **Mới**; không có đường nào để khách tự đưa yêu cầu
  của mình thành "Đã xử lý".

## Dữ liệu

- Bảng `job_requests`: `name` (họ tên), `contact` (cách liên hệ), `content` (nội dung
  việc), `status` (`moi` / `da_xu_ly`).
- Mã nguồn: controller backend `app/Http/Controllers/YeuCau/JobRequestController.php`,
  controller nhận form công khai `app/Http/Controllers/YeuCau/PublicJobRequestController.php`,
  model `app/Models/JobRequest.php`, route `routes/yeucau.php`, giao diện
  `resources/views/yeucau/`, test `tests/Feature/YeuCau/JobRequestTest.php`.
