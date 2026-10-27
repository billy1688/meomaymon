<x-app-layout>
    <x-slot name="header">
        <div class="az-page-header" style="margin-bottom: 0;">
            <h2 class="az-page-title">Thêm dòng sổ việc ngoài</h2>
            <div class="az-page-actions">
                <a href="{{ route('admin.soviec.index') }}" class="btn btn-outline-secondary">Quay lại</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('admin.soviec.store') }}" method="POST">
                    @csrf
                    @include('soviec._form')
                    <button type="submit" class="btn btn-primary">Lưu dòng sổ</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
