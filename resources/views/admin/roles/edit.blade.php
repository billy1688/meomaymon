<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sửa Role: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        {{-- Tên Role --}}
                        <div class="mb-6">
                            <x-input-label for="name" value="Tên Role" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('name', $role->name)"
                                required
                                autofocus
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Danh sách Permissions --}}
                        <div class="mb-6">
                            <x-input-label value="Permissions" />
                            <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3 max-h-80 overflow-y-auto p-3 border rounded-md dark:border-gray-600">
                                @forelse($permissions as $permission)
                                    <label class="inline-flex items-center">
                                        <input
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->name }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            {{ in_array($permission->name, $rolePermissions ?? []) ? 'checked' : '' }}
                                        >
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $permission->name }}
                                        </span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">Chưa có permission nào.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Nút bấm --}}
                        <div class="flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('admin.roles.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 transition">
                                Hủy
                            </a>

                            <x-primary-button>
                                Cập nhật Role
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
