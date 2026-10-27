<x-app-layout>
    <x-slot name="header">
        <div class="az-page-header" style="margin-bottom: 0;">
            <h2 class="az-page-title">Thêm yêu cầu việc</h2>
            <div class="az-page-actions">
                <a href="{{ route('admin.yeucau.index') }}" class="btn btn-outline-secondary">Quay lại</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('admin.yeucau.store') }}" method="POST">
                    @csrf
                    @include('yeucau._form')
                    <button type="submit" class="btn btn-primary">Lưu yêu cầu</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
