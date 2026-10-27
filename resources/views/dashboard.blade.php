<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Xin chào, {{ Auth::user()->name }}!</h3>
                    
                    <p class="mb-4">Bạn đang đăng nhập với role: 
                        <strong>
                            {{ Auth::user()->getRoleNames()->implode(', ') ?: 'Chưa có role' }}
                        </strong>
                    </p>

                    @can('manage roles')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <a href="{{ route('admin.roles.index') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center">
                                Quản lý Roles
                            </a>
                            <a href="{{ route('admin.permissions.index') }}" 
                               class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center">
                                Quản lý Permissions
                            </a>
                            <a href="{{ route('admin.users.index') }}" 
                               class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center">
                                Quản lý Users
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
