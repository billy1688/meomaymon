<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bảng điều khiển — Mèo Máy Mon
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-3 text-gray-700">Xin chào, {{ Auth::user()->name }}! Đây là khu quản trị của trang
                <strong>Mèo Máy Mon</strong> — nơi ghi sổ việc ngoài và xử lý yêu cầu khách gửi về.
                Trang chủ công khai chỉ hiện các dòng sổ đã đánh dấu <strong>Đã thu</strong>.</p>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="card border shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <div class="small text-body-secondary">💰 Tổng đã thu (việc ngoài)</div>
                            <div class="h4 fw-semibold mb-1">{{ number_format($tongDaThu, 0, ',', '.') }}đ</div>
                            <div class="small text-body-secondary">Chỉ cộng các dòng sổ ở trạng thái Đã thu — đúng số hiện ở Sổ công khai.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <div class="small text-body-secondary">📒 Tổng số dòng trong sổ</div>
                            <div class="h4 fw-semibold mb-1">{{ number_format($soDongSo, 0, ',', '.') }}</div>
                            <div class="small text-body-secondary">Gồm cả dòng đã thu và chưa thu.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <div class="small text-body-secondary">📥 Yêu cầu việc đang chờ xử lý</div>
                            <div class="h4 fw-semibold mb-1">{{ number_format($soYeuCauMoi, 0, ',', '.') }}</div>
                            <div class="small text-body-secondary">Yêu cầu khách gửi từ form ở trang chủ, đang ở trạng thái Mới.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Thẻ điều hướng dạng dashboard card — mẫu §6 Azinalogi UI Standard v1 --}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                @can('soviec.view')
                    <div class="col">
                        <a href="{{ route('admin.soviec.index') }}" class="card h-100 border shadow-sm rounded-3 text-decoration-none">
                            <div class="card-body p-4 d-flex align-items-start gap-3">
                                <span class="fs-3">📒</span>
                                <span class="flex-grow-1">
                                    <span class="h6 fw-semibold d-block text-body">Sổ việc ngoài</span>
                                    <span class="small text-body-secondary">Ghi từng việc ngoài đã nhận: ngày, khách, số tiền, đã thu hay chưa. Dòng Đã thu hiện lên Sổ công khai.</span>
                                </span>
                                <span aria-hidden="true">→</span>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('yeucau.view')
                    <div class="col">
                        <a href="{{ route('admin.yeucau.index') }}" class="card h-100 border shadow-sm rounded-3 text-decoration-none">
                            <div class="card-body p-4 d-flex align-items-start gap-3">
                                <span class="fs-3">📥</span>
                                <span class="flex-grow-1">
                                    <span class="h6 fw-semibold d-block text-body">Yêu cầu việc</span>
                                    <span class="small text-body-secondary">Yêu cầu khách gửi từ form ở trang chủ. Đang có {{ number_format($soYeuCauMoi, 0, ',', '.') }} yêu cầu mới chờ xử lý.</span>
                                </span>
                                <span aria-hidden="true">→</span>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('user.view')
                    <div class="col">
                        <a href="{{ route('admin.users.index') }}" class="card h-100 border shadow-sm rounded-3 text-decoration-none">
                            <div class="card-body p-4 d-flex align-items-start gap-3">
                                <span class="fs-3">👤</span>
                                <span class="flex-grow-1">
                                    <span class="h6 fw-semibold d-block text-body">Quản lý User</span>
                                    <span class="small text-body-secondary">Tài khoản đăng nhập backend và phân quyền của hệ thống.</span>
                                </span>
                                <span aria-hidden="true">→</span>
                            </div>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
