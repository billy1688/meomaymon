<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tạo User mới
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-4">
                            <x-input-label for="name" value="Họ tên" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <x-input-label for="password" value="Mật khẩu" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="mb-6">
                            <x-input-label for="password_confirmation" value="Xác nhận mật khẩu" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                        </div>

                        {{-- Roles --}}
                        <div class="mb-6">
                            <x-input-label value="Gán Roles" />
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach($roles as $role)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                               {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 rounded-md text-sm">Hủy</a>
                            <x-primary-button>Tạo User</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
