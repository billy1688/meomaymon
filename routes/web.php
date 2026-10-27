<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrangChu\HomeController;
use Illuminate\Support\Facades\Route;

// trang chủ công khai — Mèo Máy Mon nhận việc ngoài (không cần đăng nhập)
Route::get('/', [HomeController::class, 'index'])->name('home');

// dashboard
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// đăng nhập
require __DIR__.'/auth.php';

// module Sổ việc ngoài + module Yêu cầu việc
require __DIR__.'/soviec.php';
require __DIR__.'/yeucau.php';

// phân quyền và users
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});
