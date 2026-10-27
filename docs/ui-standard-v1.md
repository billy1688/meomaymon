# Azinalogi UI Standard v1

**Phạm vi:** Toàn bộ giao diện Admin và Khách hàng, bao gồm danh sách, chi tiết, create/edit, modal và mobile. Dùng **Bootstrap 5.3**, tận dụng class có sẵn; CSS tùy chỉnh dùng chung, không thêm framework giao diện khác. Chỉ thay đổi trình bày, không thay đổi nghiệp vụ.

## 1. Màu nút theo ý nghĩa

| Hành động | Class / màu |
|---|---|
| Tạo mới, thêm, lưu, xác nhận thông thường | `btn btn-primary` — #0D6EFD |
| Duyệt, hoàn tất, thanh toán | `btn btn-success` — #198754 |
| Chỉnh sửa, cập nhật | `btn btn-az-orange` — #FD7E14 |
| Xem chi tiết | `btn btn-outline-primary` |
| Lọc, xuất dữ liệu, quay lại, đóng | `btn btn-outline-secondary` |
| Xóa, thao tác phá hủy | `btn btn-outline-danger`, modal xác nhận |
| Trạng thái không tương tác | `badge`, không dùng button |

Ba màu nhận diện hành động: **xanh dương, xanh lá, cam**. Màu cam là biến thể **custom** (`btn-az-orange`), **không phải** `btn-warning` mặc định Bootstrap (vàng #FFC107). Đảm bảo tương phản chữ và trạng thái hover/focus/disabled; không phân biệt trạng thái chỉ bằng màu. Một khu vực nên có một CTA nổi bật nhất. Không tô màu đặc lặp lại ở hàng trăm nút trong bảng; dùng outline hoặc icon + accessible label.

## 2. Table

- Mặc định: `table table-hover align-middle` trong `table-responsive`.
- Giữ **đường phân cách ngang mảnh**, không dùng `table-bordered` trừ khi bảng dạng ma trận cần kẻ ô.
- Hover đổi nền **nhẹ** toàn dòng; vẫn đủ tương phản và không che trạng thái đã chọn.
- `table-sm` cho bảng dữ liệu dày; cột số tiền căn phải, số dễ đọc; hành động dùng `btn-sm`.
- Mobile: cho phép cuộn ngang hoặc chuyển card nếu bảng nhiều cột; không làm mất dữ liệu hay hành động.

## 3. Form Create/Edit

- `form-label` phía trên; `form-control`, `form-select`, `form-check` theo Bootstrap 5.3.
- Input/select/textarea có **viền 1px dễ thấy**, focus có viền và focus ring rõ; không dùng `border-0` / `form-control-plaintext` cho trường chỉnh sửa.
- Label và thông báo lỗi rõ ràng; dùng `is-invalid` / `invalid-feedback` khi validation lỗi.
- Nhóm trường theo card hoặc section có tiêu đề ngắn; `mb-3`, `gap-2`/`gap-3` nhất quán.
- Không thu nhỏ vùng chạm các thao tác quan trọng trên mobile.

## 4. Header và typography

- Tiêu đề trang: khoảng **20px**, `fw-semibold`, ưu tiên `h5`; tiêu đề nhóm khoảng 16px.
- Breadcrumb / mô tả phụ: `small text-body-secondary`, chỉ hiển thị khi hữu ích.
- **Bắt buộc:** Nút hành động chính của trang danh sách (ví dụ `+ Tạo mới`, `+ Thêm`, `Xuất dữ liệu` khi là hành động cấp trang) phải nằm **cùng vùng header với tiêu đề**, căn phải trên desktop; không đặt rời thành một hàng bên dưới tiêu đề. Trên mobile được phép tự xuống dòng để không tràn màn hình.
- Dùng chung `.az-page-header` bao quanh `.az-page-title` và vùng `.az-page-actions` (hoặc nút trực tiếp). Tương đương Bootstrap: `d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3`; không tự viết bố cục khác ở từng module.
- Nút `+ Tạo mới` / `+ Thêm` bắt buộc dùng `btn btn-primary` (có thể `btn-sm` nếu cần); không dùng xanh lá cho thao tác tạo mới. Nếu có nhiều hành động cấp trang, nhóm trong `.az-page-actions` với `d-flex flex-wrap gap-2`.
- **Bắt buộc trên trang Create/Edit có form chính:** Đặt nút `Hủy` / `Quay lại` (viền xám) và `Lưu` / `Lưu thay đổi` (xanh dương) cùng hàng tiêu đề, căn phải trong `.az-page-actions`; không lặp lại cùng bộ nút ở cuối form. Khi nút submit nằm ngoài `<form>`, gán `id` duy nhất cho form và `form="id"` cho button để giữ HTML validation, CSRF, phương thức và submit chuẩn. Không di chuyển nút thao tác của từng dòng bảng hoặc modal lên header.
- **Một thanh tiêu đề Admin duy nhất:** Không dùng topbar riêng. Header cấp trang dùng `position: sticky; top: 0`, nền đặc và z-index thấp hơn sidebar/overlay; tiêu đề bên trái, các hành động cấp trang bên phải. Trên mobile, nút tự xuống dòng; kiểm tra zoom, bàn phím và vùng hiển thị. Không áp dụng sticky mặc định cho khu khách hàng nếu layout khác.
- **Điều hướng Admin:** Nút thu gọn/mở rộng menu đặt cạnh logo Azinalogi trong sidebar trên desktop; logo liên kết Admin Dashboard (thay liên kết Trang chủ trên topbar). Tên người dùng và menu Hồ sơ/Đăng xuất nằm cuối sidebar. Mobile dùng nút mở sidebar trong thanh tiêu đề sticky, hỗ trợ đóng bằng Escape/overlay. Không lặp lại topbar.
- Nội dung cơ bản khoảng 14px nếu phù hợp, không làm nhỏ văn bản bắt buộc để đọc.
- Tránh khoảng trắng quá lớn; ưu tiên `mb-3` thay `mb-5`.

## 5. Buttons & consistency

- Nút chính dùng kích thước Bootstrap mặc định; nút bảng dùng `btn-sm`.
- Icon đi cùng nhãn ở thao tác quan trọng; icon-only phải có `aria-label` / `title`.
- Loading/disabled hiển thị rõ, tránh double-submit. **Xóa:** dùng nút `btn btn-outline-danger btn-sm` trong bảng và modal Bootstrap 5.3 xác nhận chung (nút Hủy xám, nút Xóa đỏ). Admin dùng `data-az-confirm-delete` trên form để kích hoạt modal; không sử dụng `window.confirm()` riêng lẻ. Giữ nguyên CSRF, DELETE method, route và quyền.
- **Tỷ giá/phí dịch vụ:** Lịch sử giá/phí là dữ liệu theo phiên bản; thay đổi bằng thêm bản ghi mới, không hiển thị nút Edit cho bản ghi cũ khi backend không hỗ trợ sửa. Nút thêm dòng mới là hành động cấp trang, đặt trong sticky header và gửi form bằng thuộc tính `form`.
- Dùng chung token/class và Blade component nếu có; **không sửa tay rời rạc từng màn hình**.
- Admin và Khách hàng dùng cùng ngữ nghĩa màu, table/form/header; khu Khách hàng giữ bố cục responsive riêng khi cần.
- **Khu Khách hàng / Đơn hàng:** Ba nút tạo đơn của trang danh sách nằm bên phải tiêu đề `Đơn hàng của tôi`. Trên cả ba trang tạo đơn (mua hộ, ký gửi, thanh toán hộ), nút `Quay lại` và `Tạo đơn` đặt cùng header bên phải, không lặp nút ở cuối form. Dùng `form` + `id` khi nút submit nằm ngoài form; giữ thao tác `Xem trước tổng tiền` trong ngữ cảnh form mua hộ. Header khách hàng sticky dưới thanh điều hướng 64px (`top:64px`), responsive trên mobile.

- **Trang Tài khoản khách hàng:** Bootstrap card gọn cho thông tin cá nhân và đổi mật khẩu; nhãn và validation tiếng Việt. Nút Quay lại và Lưu thông tin nằm bên phải header sticky; nút Đổi mật khẩu nằm trong form riêng. **Không cung cấp tự xóa tài khoản**, theo chính sách khóa mềm tài khoản bên dưới.

## 6. Thẻ điều hướng — Dashboard cards (mẫu A, chốt 25/10/2026)

- Trang **Danh mục & cấu hình** sử dụng Bootstrap 5.3 dashboard cards: `row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3`, mỗi mục là `col` chứa liên kết `card h-100 border shadow-sm rounded-3` và `card-body p-4`.
- Thẻ có biểu tượng/symbol bên trái, ký hiệu điều hướng bên phải, tiêu đề `h6 fw-semibold`, mô tả `small text-body-secondary`. Không thêm dependency icon mới chỉ để hiển thị thẻ.
- Toàn bộ thẻ là liên kết, giữ route và `@can` hiện có; hỗ trợ focus bàn phím rõ ràng, hover nhẹ, tương phản tốt, không phụ thuộc màu để truyền tải ý nghĩa.
- Khoảng cách đồng đều, chiều cao các thẻ bằng nhau trong mỗi hàng; 1 cột mobile, 2 cột tablet, 3 cột desktop lớn. Không trộn class Tailwind để bố trí các thẻ này.
- Đây là mẫu chuẩn cho **trang điều hướng dạng dashboard card**; không ép bảng dữ liệu, form và trang chi tiết chuyển sang dạng thẻ.

## 7. Triển khai và nghiệm thu

1. Kiểm kê CSS, layout, Blade component, tránh override trùng lặp.
2. Tạo style/component dùng chung, rồi chuyển dần màn hình.
3. Kiểm tra list/create/edit/detail, modal, validation, hover/focus, keyboard, dark mode (nếu có), mobile.
4. Không thay đổi công thức tính phí, quyền, route, dữ liệu, hoặc nghiệp vụ.
5. Tuân thủ quy trình repository: kiểm tra code, merge/deploy rồi QA giao diện thực tế.

## Bảo mật tài khoản (25/10/2026)

- Không cho khách hàng tự xóa tài khoản: không hiển thị nút và không đăng ký DELETE `/profile`.
- Admin có quyền `user.edit` mới được khóa/mở khóa; không được tự khóa tài khoản hiện tại.
- Khóa mềm giữ nguyên tài khoản, Nick, đơn hàng, công nợ và lịch sử; `locked_at`, `locked_by`, `lock_reason` ghi nhận trạng thái và người thực hiện, có log hành động.
- Chặn đăng nhập email/username (bcrypt và legacy Yii), đồng thời từ chối phiên đã đăng nhập tại request tiếp theo. Mở khóa không đặt lại mật khẩu.
- Không xóa cứng user ở Admin; xử lý yêu cầu xóa dữ liệu cá nhân theo quy trình riêng.
