# Module Sổ việc ngoài

## Module này để làm gì

Đây là cuốn sổ ghi lại các **việc ngoài** Mon nhận làm cho khách (làm web, chăm fanpage,
kiểm thử web, soạn tài liệu). Mỗi việc là một dòng trong sổ. Cuốn sổ này là nguồn số liệu
cho mục **Sổ công khai** ở trang chủ: ai ghé trang cũng coi được Mon đã thu được bao nhiêu
tiền từ việc ngoài — nhưng chỉ các việc **đã thu tiền thật** mới hiện ra ngoài.

Ví dụ chạy xuyên suốt: ngày 05/11/2026 Mon giao xong trang web giới thiệu cho shop quần áo
của chị Lan, giá gói giới thiệu 4.900.000đ, chị Lan đã chuyển khoản đủ. Dòng sổ ghi:
ngày 05/11/2026 · việc "Làm trang web giới thiệu cho shop quần áo" · khách "Chị Lan (shop
quần áo)" · số tiền 4.900.000 · trạng thái **Đã thu**. Ngay sau đó, trang chủ hiện thêm
dòng này trong bảng Sổ công khai và tổng đã thu tăng thêm 4.900.000đ.

## Ai dùng, ở đâu

- Chỉ dùng trong **khu quản trị** (đăng nhập mới vào được), menu **Sổ việc ngoài**.
- Quyền: `soviec.view` (xem danh sách), `soviec.create` (thêm dòng), `soviec.edit` (sửa),
  `soviec.delete` (xoá). Vai admin có đủ 4 quyền.

## Các màn hình và nút bấm

- **Danh sách sổ:** bảng gồm Ngày · Việc · Khách · Số tiền · Trạng thái · Hành động.
  Phía trên bảng có khung xanh ghi rõ lệ của sổ và tổng đã thu hiện tại. Nút **+ Thêm dòng
  sổ** (góc phải trên) mở form thêm. Mỗi dòng có nút **Sửa** (màu cam) và **Xoá** (viền đỏ,
  bấm vào sẽ hiện hộp hỏi lại trước khi xoá thật).
- **Form thêm / sửa dòng sổ** gồm 6 ô:
  1. **Ngày** — ngày của việc (mặc định là hôm nay).
  2. **Tên việc** — việc đã làm, ví dụ "Chăm fanpage tháng 11". Tên này HIỆN ra trang
     công khai nếu dòng ở trạng thái Đã thu, nên viết gọn và rõ.
  3. **Khách** — tên khách/shop. Ô này CHỈ nằm trong backend, không hiện công khai.
  4. **Số tiền (đồng)** — ghi số nguyên, ví dụ 1900000. Chỉ tính vào tổng thu khi trạng
     thái là Đã thu.
  5. **Trạng thái** — chọn **Chưa thu** hoặc **Đã thu**.
  6. **Ghi chú** — ghi thêm bối cảnh của việc (gói nào, giao tới đâu), không bắt buộc.
  Nút **Lưu dòng sổ** / **Lưu thay đổi** ở cuối form; nút **Quay lại** ở góc phải trên.

## Lệ của sổ (quan trọng)

- **Chỉ dòng "Đã thu" mới hiện công khai và tính vào tổng thu.** Dòng "Chưa thu" chỉ đội
  nhà thấy trong backend. Ví dụ: Mon đã giao bản nháp web cho khách nhưng khách chưa trả
  tiền → ghi dòng ở trạng thái Chưa thu; khi tiền về thật mới sửa dòng đó sang Đã thu.
- **Không ghi khống:** số tiền trong sổ phải là số tiền thật của việc. Sổ trống thì trang
  chủ hiện câu trung thực "Sổ đang ở số 0 — Mon đang chờ khách đầu tiên." chứ không bịa số.
- Tên khách và ghi chú **không bao giờ** hiện ra trang công khai — ngoài trang chỉ có
  Ngày, Tên việc và Số tiền của các dòng Đã thu.

## Dữ liệu

- Bảng `work_ledger_entries`: `work_date` (ngày), `title` (tên việc), `client` (khách,
  để trống được), `amount` (số tiền, số nguyên đồng), `status` (`chua_thu` / `da_thu`),
  `note` (ghi chú).
- Mã nguồn: controller `app/Http/Controllers/SoViec/WorkLedgerController.php`, model
  `app/Models/WorkLedgerEntry.php`, route `routes/soviec.php`, giao diện
  `resources/views/soviec/`, test `tests/Feature/SoViec/WorkLedgerTest.php`.
