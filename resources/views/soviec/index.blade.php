<x-app-layout>
    <x-slot name="header">
        <div class="az-page-header" style="margin-bottom: 0;">
            <h2 class="az-page-title">Sổ việc ngoài</h2>
            <div class="az-page-actions">
                @can('soviec.create')
                    <a href="{{ route('admin.soviec.create') }}" class="btn btn-primary">+ Thêm dòng sổ</a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="alert alert-info">
                Đây là <strong>sổ ghi các việc ngoài Mon nhận làm cho khách</strong>. Chỉ những dòng ở
                trạng thái <strong>Đã thu</strong> mới hiện lên mục Sổ công khai ở trang chủ và mới tính
                vào tổng thu — tiền chỉ tính khi đã thật về tay. Tổng đã thu hiện tại:
                <strong>{{ number_format($tongDaThu, 0, ',', '.') }}đ</strong>.
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Ngày</th>
                                <th style="min-width: 200px;">Việc</th>
                                <th>Khách</th>
                                <th class="text-end text-nowrap">Số tiền</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entries as $entry)
                                <tr>
                                    <td class="text-nowrap">{{ $entry->work_date->format('d/m/Y') }}</td>
                                    <td class="fw-medium">
                                        {{ $entry->title }}
                                        @if($entry->note)
                                            <div class="small text-body-secondary">{!! nl2br(e($entry->note)) !!}</div>
                                        @endif
                                    </td>
                                    <td>{{ $entry->client ?: '—' }}</td>
                                    <td class="text-end text-nowrap">{{ number_format($entry->amount, 0, ',', '.') }}đ</td>
                                    <td>
                                        @if($entry->isReceived())
                                            <span class="badge text-bg-success">Đã thu</span>
                                        @else
                                            <span class="badge text-bg-warning">Chưa thu</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-nowrap">
                                        @can('soviec.edit')
                                            <a href="{{ route('admin.soviec.edit', $entry) }}" class="btn btn-az-orange btn-sm">Sửa</a>
                                        @endcan
                                        @can('soviec.delete')
                                            <form action="{{ route('admin.soviec.destroy', $entry) }}" method="POST" class="d-inline" data-az-confirm-delete>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Xoá</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-body-secondary py-4">Sổ chưa có dòng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $entries->links() }}
            </div>
        </div>
    </div>

    @include('components.az-delete-modal')
</x-app-layout>
