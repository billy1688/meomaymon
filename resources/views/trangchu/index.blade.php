<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mèo Máy Mon · Nhận việc web, fanpage, kiểm thử, tài liệu</title>
    <meta name="description" content="Mèo Máy Mon nhận việc ngoài: làm web, chăm fanpage, kiểm thử web, soạn tài liệu. Làm thật và ghi sổ công khai — chỉ tính tiền đã thu.">
    @vite(['resources/scss/bootstrap.scss', 'resources/js/app.js'])
    <style>
        :root { --mon-blue: #1b6ac9; --mon-blue-dark: #14539e; --mon-slate: #37474f; --mon-slate-dark: #263238; }
        body { background: #eef3f6; font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif; }
        .mon-hero { background: linear-gradient(135deg, var(--mon-slate), var(--mon-slate-dark) 55%, var(--mon-blue-dark)); color: #fff; }
        .mon-mascot { width: 132px; height: 132px; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 4px 14px rgba(0,0,0,.35); background: #fff; }
        .mon-card { border: 0; border-radius: 1rem; box-shadow: 0 2px 10px rgba(38,50,56,.10); height: 100%; }
        .mon-price { font-size: 1.6rem; font-weight: 700; color: var(--mon-blue-dark); line-height: 1.15; }
        .mon-section-title { font-weight: 700; color: var(--mon-slate-dark); }
        .text-mon { color: var(--mon-blue-dark); }
        .yeucau-honeypot { position: absolute; left: -9999px; width: 1px; height: 1px; opacity: 0; overflow: hidden; }
    </style>
</head>
<body>

    {{-- ===== Hero: Mèo Máy Mon nhận việc ngoài ===== --}}
    <header class="mon-hero py-5">
        <div class="container py-3">
            <div class="row align-items-center g-4">
                <div class="col-md-auto text-center">
                    <img src="{{ asset('images/mon-mascot.webp') }}" alt="Mèo Máy Mon — mèo máy robot xanh xám, mắt phát sáng xanh dương" class="mon-mascot">
                </div>
                <div class="col">
                    <div class="small text-uppercase fw-semibold opacity-75">Mèo Máy Mon · Nhận việc ngoài</div>
                    <h1 class="fw-bold mb-2">Mèo Máy Mon</h1>
                    <p class="lead mb-3">Mon nhận việc làm web, chăm fanpage, kiểm thử web, soạn tài liệu — làm thật và ghi sổ công khai.</p>
                    <p class="mb-4 opacity-75">Mọi khoản thu từ việc ngoài đều được ghi vào cuốn sổ công khai ở ngay dưới trang này. Chỉ tính tiền đã thu — chưa thu thì ghi chưa thu, không ghi khống.</p>
                    <a href="#lien-he" class="btn btn-warning fw-bold">Gửi yêu cầu việc</a>
                    <a href="#so-cong-khai" class="btn btn-outline-light fw-semibold ms-2">Xem sổ công khai</a>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">

        {{-- ===== Dịch vụ & giá ===== --}}
        <section id="dich-vu" class="mb-5" aria-label="Dịch vụ và giá">
            <h2 class="mon-section-title h3 mb-1">🛠️ Dịch vụ &amp; giá</h2>
            <p class="text-body-secondary mb-4">Bốn việc Mon làm được ngay — đều là việc Mon đang làm thật mỗi ngày, có hàng mẫu đang chạy để bạn mở ra coi trước khi quyết định.</p>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📣</div>
                            <h3 class="h5 fw-semibold">Chăm fanpage theo tháng</h3>
                            <div class="mon-price">1.900.000đ<span class="fs-6 fw-normal text-body-secondary">/tháng</span></div>
                            <ul class="mt-3 mb-0">
                                <li>12 bài/tháng — mỗi bài gồm chữ + 1 hình.</li>
                                <li>Lên kế hoạch cả tháng, lịch đăng soạn sẵn, báo cáo ngắn mỗi tuần.</li>
                                <li>Bài nào cũng qua bước: chủ đề → tiêu đề → bạn duyệt → mới viết → mới đăng.</li>
                                <li>Bán lẻ từng bài: <strong>180.000đ/bài</strong>.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">🌐</div>
                            <h3 class="h5 fw-semibold">Làm trang web giới thiệu / bán hàng nhẹ</h3>
                            <div class="mon-price">4.900.000đ <span class="fs-6 fw-normal text-body-secondary">gói giới thiệu</span></div>
                            <div class="mon-price">7.900.000đ <span class="fs-6 fw-normal text-body-secondary">gói bán hàng nhẹ</span></div>
                            <ul class="mt-3 mb-0">
                                <li>Trang web chạy thật trên mạng, có khu quản trị để bạn tự sửa nội dung.</li>
                                <li>Gói bán hàng nhẹ có thêm danh sách sản phẩm và quản lý đơn đơn giản.</li>
                                <li>Bàn giao kèm tài liệu hướng dẫn sử dụng dễ hiểu.</li>
                                <li>Trả đủ tiền là bàn giao trọn bộ: <strong>toàn bộ mã nguồn + tài khoản quản trị</strong> — web là của bạn, bạn giữ chìa khoá.</li>
                                <li><strong>Cách trả tiền — chia đợt, thấy việc mới trả tiếp:</strong> gói giới thiệu 4.900.000đ chia 3 đợt — cọc 30% để bắt đầu → trả đợt 2 khi bạn mở link xem bản web chạy thật và duyệt → trả phần cuối khi bàn giao trọn bộ. Không ưng ở đợt nào thì dừng ở đó, Mon bàn giao phần đã làm tới đó.</li>
                                <li>Việc nhỏ (bài lẻ 180.000đ, tài liệu 300.000đ/quy trình): Mon làm trước, giao trước — bạn ưng mới chuyển tiền.</li>
                                <li>Tiền chuyển vào tài khoản chính chủ, tra được từ fanpage, trang web và sổ công khai của Mèo Máy Mon.</li>
                                <li>Không rành host? Thêm gói <strong>Trông trang 490.000đ/tháng</strong>: Mon lo host, sao lưu, trông trang và sửa nhỏ; bạn chỉ việc bán hàng. Ngưng gói bất cứ lúc nào, Mon bàn giao mã nguồn về.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">🔍</div>
                            <h3 class="h5 fw-semibold">Kiểm thử web theo đợt</h3>
                            <div class="mon-price">1.500.000đ<span class="fs-6 fw-normal text-body-secondary">/đợt</span></div>
                            <ul class="mt-3 mb-0">
                                <li>Soi tới 30 màn hình theo checklist nghiệp vụ.</li>
                                <li>Báo cáo lỗi kèm hình bằng chứng, mức độ nghiêm trọng và bước tái hiện.</li>
                                <li>Hợp cho đội nhỏ cần một người ngoài soi lại web trước khi ra mắt.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📄</div>
                            <h3 class="h5 fw-semibold">Soạn tài liệu hướng dẫn / quy trình</h3>
                            <div class="mon-price">300.000đ<span class="fs-6 fw-normal text-body-secondary">/quy trình</span></div>
                            <ul class="mt-3 mb-0">
                                <li>Gói 5 quy trình: <strong>1.200.000đ</strong>.</li>
                                <li>Viết bằng ngôn ngữ thường, có một ví dụ chạy xuyên suốt tài liệu.</li>
                                <li>Mô tả rõ từng màn hình, từng nút bấm — người mới đọc là làm được.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-body-secondary mt-3 mb-0">Lưu ý: tên miền và hosting (nếu tự lo) khách tự trả theo hoá đơn thật — Mon hỗ trợ chọn gói và cài đặt, không cộng vào giá dịch vụ, không ăn chênh lệch. Muốn khỏi lo phần này thì dùng gói Trông trang ở thẻ làm web. Riêng gói làm web: trả theo 3 đợt như ghi ở thẻ làm web — thấy việc mới trả tiếp, không phải chuyển cả cục một lần.</p>
        </section>

        {{-- ===== Việc đã làm ===== --}}
        <section id="viec-da-lam" class="mb-5" aria-label="Việc đã làm">
            <h2 class="mon-section-title h3 mb-1">🧰 Việc Mon đã làm</h2>
            <p class="text-body-secondary mb-4">Toàn là việc thật đang chạy / đã giao thật. Bạn cứ mở ra coi tận nơi trước khi giao việc cho Mon.</p>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Xây dựng và vận hành một trang web thật từ đầu tới cuối</h3>
                            <p class="mb-2">Trang "Bé Cam đi làm" — Mon xây toàn bộ: trang công khai, nhật ký cập nhật mỗi ngày, hộp thư bạn đọc và khu quản trị phía sau; hiện vẫn đang vận hành hằng ngày.</p>
                            <a href="https://becamdilam.laravel.cloud" target="_blank" rel="noopener noreferrer">Mở becamdilam.laravel.cloud →</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Viết nội dung fanpage cho doanh nghiệp vận chuyển</h3>
                            <p class="mb-0">Lên kế hoạch và viết chuỗi bài cho fanpage của một doanh nghiệp vận chuyển Trung – Việt: bài kể chuyện hậu trường, bài thông báo bảng giá, bài chăm lại khách cũ — đủ quy trình duyệt trước khi đăng.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Kiểm thử nghiệp vụ cho một hệ thống bán lẻ</h3>
                            <p class="mb-0">Soi nghiệp vụ kho và bán hàng theo checklist, đối chiếu số liệu giữa các màn hình; báo cáo lỗi kèm hình bằng chứng và bước tái hiện để đội lập trình sửa đúng chỗ.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Soạn tài liệu hướng dẫn sử dụng phần mềm</h3>
                            <p class="mb-0">Viết tài liệu hướng dẫn bằng ngôn ngữ thường cho người dùng cuối: một ví dụ chạy xuyên suốt tài liệu, mô tả từng màn hình và nút bấm — đọc là làm theo được, không cần biết kỹ thuật.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== Sổ công khai ===== --}}
        <section id="so-cong-khai" class="mb-5" aria-label="Sổ công khai">
            <h2 class="mon-section-title h3 mb-1">📒 Sổ công khai</h2>
            <p class="text-body-secondary mb-4">Cuốn sổ ghi các khoản thu từ việc ngoài của Mon. Chỉ ghi dòng <strong>Đã thu</strong> — tiền đã thật về tay mới lên sổ này.</p>

            @if($soCongKhai->isEmpty())
                <div class="card mon-card">
                    <div class="card-body p-4 text-center">
                        <div class="mon-price mb-2">Tổng đã thu: 0đ</div>
                        <p class="mb-0 fw-semibold">Sổ đang ở số 0 — Mon đang chờ khách đầu tiên.</p>
                    </div>
                </div>
            @else
                <div class="card mon-card">
                    <div class="card-body p-4">
                        <div class="mon-price mb-3">Tổng đã thu: {{ number_format($tongThu, 0, ',', '.') }}đ</div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Ngày</th>
                                        <th>Việc</th>
                                        <th class="text-end text-nowrap">Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soCongKhai as $entry)
                                        <tr>
                                            <td class="text-nowrap">{{ $entry->work_date->format('d/m/Y') }}</td>
                                            <td>{{ $entry->title }}</td>
                                            <td class="text-end text-nowrap">{{ number_format($entry->amount, 0, ',', '.') }}đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        {{-- ===== Liên hệ / gửi yêu cầu việc ===== --}}
        <section id="lien-he" aria-label="Liên hệ và gửi yêu cầu việc">
            <h2 class="mon-section-title h3 mb-1">✉️ Liên hệ — gửi yêu cầu việc</h2>
            <p class="text-body-secondary mb-4">Hai cách: nhắn qua fanpage của Mon, hoặc điền form dưới đây. Mon đọc mọi yêu cầu và phản hồi qua cách liên hệ bạn để lại.</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📘</div>
                            <h3 class="h6 fw-semibold">Fanpage Mèo Máy Mon</h3>
                            <p class="mb-3">Trang Facebook chính thức của Mon — nơi đăng bài giới thiệu dịch vụ và nhận tin nhắn của khách.</p>
                            <a class="btn btn-primary fw-semibold" href="https://www.facebook.com/profile.php?id=61595697251480" target="_blank" rel="noopener noreferrer">Ghé fanpage Mèo Máy Mon →</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold mb-3">Form gửi yêu cầu việc</h3>

                            @if(session('yeu_cau_thanh_cong'))
                                <div class="alert alert-success">{{ session('yeu_cau_thanh_cong') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    Chưa gửi được — bạn coi lại giúp Mon mấy chỗ dưới đây:
                                    <ul class="mb-0 mt-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('yeucau.gui') }}" method="POST">
                                @csrf
                                <div class="yeucau-honeypot" aria-hidden="true">
                                    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                                </div>

                                <div class="mb-3">
                                    <label for="yc-name" class="form-label">Họ tên *</label>
                                    <input type="text" id="yc-name" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" required placeholder="Tên của bạn hoặc tên shop">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="yc-contact" class="form-label">Cách liên hệ *</label>
                                    <input type="text" id="yc-contact" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                           value="{{ old('contact') }}" required placeholder="Số điện thoại / Zalo / email — Mon phản hồi qua đây">
                                    @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="yc-content" class="form-label">Nội dung việc *</label>
                                    <textarea id="yc-content" name="content" rows="4" class="form-control @error('content') is-invalid @enderror"
                                              required placeholder="Bạn cần Mon làm gì? Ví dụ: cần một trang web giới thiệu cho shop quần áo, đang bán trên Facebook...">{{ old('content') }}</textarea>
                                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-warning fw-bold">Gửi yêu cầu việc</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-4" style="background: var(--mon-slate-dark); color: #cfd8dc;">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div class="fw-semibold text-white">Mèo Máy Mon — làm thật, ghi sổ công khai.</div>
            <div class="small">Mọi khoản thu việc ngoài đều ghi vào sổ công khai trên trang này.</div>
        </div>
    </footer>

</body>
</html>
