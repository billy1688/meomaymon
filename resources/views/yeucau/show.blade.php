<x-app-layout>
    <x-slot name="header">
        <div class="az-page-header" style="margin-bottom: 0;">
            <h2 class="az-page-title">Chi tiết yêu cầu việc</h2>
            <div class="az-page-actions">
                <a href="{{ route('admin.yeucau.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                @can('yeucau.edit')
                    <a href="{{ route('admin.yeucau.edit', $jobRequest) }}" class="btn btn-az-orange">Sửa yêu cầu</a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.flash')

            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Người gửi</dt>
                    <dd class="col-sm-9">{{ $jobRequest->name }}</dd>

                    <dt class="col-sm-3">Cách liên hệ</dt>
                    <dd class="col-sm-9">{{ $jobRequest->contact }}</dd>

                    <dt class="col-sm-3">Trạng thái</dt>
                    <dd class="col-sm-9">
                        @if($jobRequest->isHandled())
                            <span class="badge text-bg-success">Đã xử lý</span>
                        @else
                            <span class="badge text-bg-warning">Mới</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Ngày gửi</dt>
                    <dd class="col-sm-9">{{ $jobRequest->created_at?->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-3">Nội dung việc</dt>
                    <dd class="col-sm-9">{!! nl2br(e($jobRequest->content)) !!}</dd>
                </dl>

                @can('yeucau.edit')
                    <div class="d-flex gap-2 mt-3">
                        @if(! $jobRequest->isHandled())
                            <form action="{{ route('admin.yeucau.trang-thai', $jobRequest) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="da_xu_ly">
                                <button type="submit" class="btn btn-success">Đánh dấu đã xử lý</button>
                            </form>
                        @else
                            <form action="{{ route('admin.yeucau.trang-thai', $jobRequest) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="moi">
                                <button type="submit" class="btn btn-outline-secondary">Mở lại (chưa xử lý)</button>
                            </form>
                        @endif
                    </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
