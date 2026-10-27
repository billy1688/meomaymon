<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tạo Permission mới
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="name" value="Tên Permission" />
                            <x-text-input id="name"
                                          name="name"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('name')"
                                          required
                                          autofocus
                                          placeholder="Ví dụ: manage users, edit posts..." />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            <p class="mt-1 text-sm text-gray-500">Nên viết dạng chữ thường, cách nhau bằng dấu cách hoặc dấu gạch ngang.</p>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.permissions.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500">
                                Hủy
                            </a>
                            <x-primary-button>
                                Tạo Permission
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
