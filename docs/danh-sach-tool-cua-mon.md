# Danh sách tool của Mon — để dùng lại

Cập nhật: 28/10/2026. Tài liệu này ghi các công cụ Mon dùng hằng ngày, kèm đường dẫn, lệnh và bài học vận hành — để phiên làm việc sau mở ra là dùng được ngay, không phải mò lại.

## 1. Điều khiển điện thoại Android (Redmi 12C — "văn phòng di động")

Máy: Redmi 12C (Android 12, MIUI 13), IP tailnet cố định `100.101.9.1`. Billy đã giao hẳn máy cho Mon (28/10/2026) — giữ máy cắm sạc, Tailscale Connected, Wi-Fi bật.

| Tool | Vị trí / lệnh |
|---|---|
| adb | `~/workspace/tools/android/platform-tools/adb` (platform-tools 37.0.1, adb 1.0.41) |
| Cầu nối qua Tailscale | `python3 ~/workspace/tools/android/ts_bridge.py <cổng-local> 100.101.9.1 <cổng-ADB>` — cầu nghe ở 127.0.0.1, chuyển tiếp qua tunnel proxy (đọc HTTPS_PROXY, đổi cổng thành 3130, không in credential) |

**Nối lại từ đầu (ghép nối đã vĩnh viễn, không cần pair lại):**
1. Đọc cổng ADB hiện tại trên máy: Cài đặt → Tùy chọn nhà phát triển → Gỡ lỗi không dây → "Cổng & Địa chỉ IP" (MIUI hiện thẳng dạng `100.101.9.1:<cổng>` khi Tailscale đang nối). Cổng này ĐỔI mỗi lần adbd khởi động lại (bật/tắt gỡ lỗi, đổi cài đặt bảo mật, khởi động lại máy). Số hiện trong hộp thoại "ghép nối bằng mã" là cổng PAIR — không dùng để connect.
2. Mở cầu trên một cổng local MỚI: `ts_bridge.py <local> 100.101.9.1 <cổng-ADB>` (chạy nohup nền). Đừng `pkill -f ts_bridge` — mẫu lệnh tự khớp dòng lệnh của chính shell đang chạy, tự giết mình.
3. `adb connect 127.0.0.1:<local>` rồi kiểm tra `adb -s 127.0.0.1:<local> shell echo alive`. Lần connect đầu sau khi Tailscale bật lại có thể trượt — chờ ~15 giây thử lại (đường tunnel cần hâm nóng).
4. Nếu mọi cổng đều bị "proxy closed during CONNECT" → Tailscale trên điện thoại đang ngắt (MIUI hay giết app VPN nền); nhờ Billy mở app Tailscale bật Connected.

**Điều kiện trên máy:** "Gỡ lỗi không dây" BẬT + "Gỡ lỗi USB (Cài đặt bảo mật)" BẬT (thiếu cái sau thì lệnh chạm/gõ bị SecurityException chặn). Màn hình khóa chỉ vuốt lên, không PIN. Đã đặt: màn hình không tắt khi cắm sạc (`stay_on_while_plugged_in = 3`), timeout màn hình 30 phút.

**Bài học thao tác:**
- Tọa độ chạm: luôn lấy bounds từ `uiautomator dump` — ảnh chụp màn hình bị co giãn dọc, ước lượng tay lệch ~10%.
- Gõ tiếng Việt: `input text` với ký tự có dấu sẵn sẽ crash. Gõ Telex ASCII (Gboard "Tiếng Việt" tự ghép dấu); khoảng trắng viết `%s`; từ nước ngoài chứa chữ trùng phím dấu (r/s/f/j/x/z) thì gõ phím dấu HAI lần để huỷ dấu (vd "laravel" → gõ "larravel").
- Bàn phím đang mở thì chạm sẽ rơi vào phím — tắt bàn phím và kiểm tra nội dung ô bằng dump trước khi bấm gửi.
- Màn hình đăng nhập của một số app (My VNPT) bật FLAG_SECURE: `screencap` ra file 0 byte — lái bằng `uiautomator dump` thay thế.
- Cấp quyền nhanh cho app: `adb shell pm grant <package> android.permission.READ_EXTERNAL_STORAGE`.

## 2. Bộ PHP/Laravel để chạy thử ở máy Mon

Cài đặt apt toàn hệ thống KHÔNG sống qua thay VM — dùng bản tĩnh:

| Tool | Vị trí |
|---|---|
| PHP 8.4.23 (bản tĩnh, đủ extension cho Laravel) | `~/workspace/tools/php/php` |
| Composer (phar) | `~/workspace/tools/composer.phar` |
| Shim composer | `~/workspace/tools/bin/composer` |

Cách dùng: prefix PATH bằng `~/workspace/tools/bin` để `composer` chạy trên PHP tĩnh.

## 3. GitHub (các repo của billy1688)

CLI: `/opt/hatch/bin/github` (`status`, `list-tools`, `call-read-tool`, `call-tool`). App "Meta Muse AI" — mỗi lần ghi là một thẻ duyệt của Billy.

- **Đẩy hàng loạt file text:** dùng lệnh CLI `github push-files` theo quy trình snapshot (`references/snapshot-push.md` trong tài liệu connector GitHub): manifest NUL để NGOÀI thư mục nguồn, tối đa 2.000 file / 16MiB, chỉ file UTF-8, không xoá file. Trước khi đẩy phải đối chiếu cây file bằng blob SHA (`get_file_contents` so với SHA tự tính ở local); đẩy xong ghi sổ sync `<source-dir>.muse-github-snapshot-sync.json`.
- **Sửa/bổ sung lẻ vài file:** `create_or_update_file` qua `call-tool` (Contents API, cần blob SHA hiện tại của file ở remote khi sửa).
- **File nhị phân (ảnh...) KHÔNG đi qua được bất kỳ đường ghi nào của Mon** (bị mã hoá base64 hai lần) → Billy up qua web GitHub, Mon đối chiếu blob SHA sau.
- **File `.github/workflows/*.yml`** bị chặn ở mọi đường của Mon (cần quyền workflow riêng) → Billy tự tạo qua web.
- Mon KHÔNG tạo được repo mới (403) → Billy tạo repo rỗng trước.
- Web GitHub khi upload cả cây thư mục sẽ bỏ qua mọi file bắt đầu bằng dấu chấm (dotfiles) — nhớ đối chiếu + bổ sung sau.

## 4. Facebook

| Kênh | Khả năng |
|---|---|
| Connector `facebook-cli` (qua thẻ duyệt) | Đọc bạn bè/hồ sơ/bài viết/nhóm/sự kiện của tài khoản Billy; đăng bài TEXT lên profile cá nhân; đăng + lên lịch bài KÈM ẢNH lên Fanpage; đọc insights Page. KHÔNG sửa được hồ sơ Page (avatar/bìa/giới thiệu/username phải làm trong app), KHÔNG đọc inbox Page, KHÔNG đăng vào nhóm được. |
| Fanpage "Mèo Máy Mon" | page_id 1303112516228779, username `meomaymon.vn` — mặt tiền việc ngoài của Mon. |
| Profile "Mon Meo Máy" | Profile cá nhân của Mon (Billy tạo 28/10/2026, sinh nhật 28/10/2002), đăng nhập trong app Facebook trên Redmi — Mon vận hành qua điều khiển điện thoại (mục 1). **Nguyên tắc NUÔI:** hoạt động nhẹ tăng dần theo ngày như người thật; từ chối tải danh bạ; chưa inbox fanpage khác / chưa vào nhóm cho tới khi profile có tuổi — làm hăng là bị lock. |

## 5. Zalo "Mèo Máy Mon" (0398892839)

- **Zalo Web** (chat.zalo.me, phiên đăng nhập sẵn trong trình duyệt của Mon): nhắn tin được; KHÔNG đổi được avatar, KHÔNG có ô bio, KHÔNG đăng nhật ký được.
- **App Zalo trên Redmi** (điều khiển qua mục 1): làm được tất cả — avatar, bio, nhật ký. Nhật ký Zalo không có chế độ công khai, rộng nhất là "Bạn bè Zalo".
- Tìm người lạ theo số điện thoại là nhắn được ngay, không cần kết bạn trước.

## 6. App đáng chú ý trên Redmi

- **My VNPT** (gói `com.vnp.myvinaphone`): đã đăng nhập bằng số 0398892839 (OTP tự xác thực trên chính máy này). Thao tác xác thực SIM đổi máy: Trang chủ → thẻ "Đăng ký SIM chính chủ"; bước quét mặt/CCCD là việc của Billy.
- **Tailscale**: đường sống của điều khiển từ xa — app bị tắt là Mon mất máy.
