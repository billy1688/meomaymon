<x-app-layout>
    <x-slot name="header">
        <div class="az-page-header" style="margin-bottom: 0;">
            <h2 class="az-page-title">Yêu cầu việc</h2>
            <div class="az-page-actions">
                @can('yeucau.create')
                    <a href="{{ route('admin.yeucau.create') }}" class="btn btn-primary">+ Thêm yêu cầu</a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="alert alert-info">
                Đây là <strong>các yêu cầu việc khách gửi từ form ở trang chủ</strong> (đội nhà cũng có thể
                thêm tay khi khách liên hệ qua fanpage). Hiện có
                <strong>{{ number_format($soYeuCauMoi, 0, ',', '.') }} yêu cầu mới</strong> đang chờ xử lý.
                Danh sách này chỉ nằm trong backend, không hiện ra trang công khai.
            </div>

            <form method="GET" action="{{ route('admin.yeucau.index') }}" class="mb-3 d-flex gap-2 align-items-center">
                <label for="trang_thai" class="form-label mb-0">Lọc theo trạng thái:</label>
                <select id="trang_thai" name="trang_thai" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="">Tất cả</option>
                    @foreach(\App\Models\JobRequest::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </form>

            <div class="bg-white shadow-sm sm:rounded-lg p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="min-width: 160px;">Người gửi</th>
                                <th>Cách liên hệ</th>
                                <th>Nội dung việc</th>
                                <th class="text-nowrap">Ngày gửi</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $jobRequest)
                                <tr>
                                    <td class="fw-medium">{{ $jobRequest->name }}</td>
                                    <td>{{ $jobRequest->contact }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($jobRequest->content, 90) }}</td>
                                    <td class="text-nowrap">{{ $jobRequest->created_at?->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($jobRequest->isHandled())
                                            <span class="badge text-bg-success">Đã xử lý</span>
                                        @else
                                            <span class="badge text-bg-warning">Mới</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-nowrap">
                                        @can('yeucau.view')
                                            <a href="{{ route('admin.yeucau.show', $jobRequest) }}" class="btn btn-outline-primary btn-sm">Xem</a>
                                        @endcan
                                        @can('yeucau.edit')
                                            <a href="{{ route('admin.yeucau.edit', $jobRequest) }}" class="btn btn-az-orange btn-sm">Sửa</a>
                                            @if(! $jobRequest->isHandled())
                                                <form action="{{ route('admin.yeucau.trang-thai', $jobRequest) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="da_xu_ly">
                                                    <button type="submit" class="btn btn-success btn-sm">Đã xử lý</button>
                                                </form>
                                            @endif
                                        @endcan
                                        @can('yeucau.delete')
                                            <form action="{{ route('admin.yeucau.destroy', $jobRequest) }}" method="POST" class="d-inline" data-az-confirm-delete>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Xoá</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-body-secondary py-4">Chưa có yêu cầu việc nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $requests->links() }}
            </div>
        </div>
    </div>

    @include('components.az-delete-modal')
</x-app-layout>
