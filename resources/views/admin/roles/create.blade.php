<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tạo Role mới</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" value="Tên Role" />
                        <x-text-input id="name" name="name" class="block mt-1 w-full" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label value="Permissions" />
                        <div class="mt-2 grid grid-cols-2 gap-2">
                            @foreach($permissions as $permission)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                    <span class="ml-2 text-sm">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.roles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Hủy</a>
                        <x-primary-button>Tạo Role</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
