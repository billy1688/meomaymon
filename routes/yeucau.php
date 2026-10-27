<?php

use App\Http\Controllers\YeuCau\JobRequestController;
use App\Http\Controllers\YeuCau\PublicJobRequestController;
use Illuminate\Support\Facades\Route;

// Form gửi yêu cầu việc công khai ở mục Liên hệ của trang chủ —
// không cần đăng nhập. Yêu cầu vào backend ở trạng thái "Mới".
Route::post('/yeu-cau', [PublicJobRequestController::class, 'store'])->name('yeucau.gui');

// Module Yêu cầu việc — khu backend, bắt buộc đăng nhập.
// Quyền chi tiết (xem/tạo/sửa/xoá) khai trong controller.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::patch('yeu-cau/{jobRequest}/trang-thai', [JobRequestController::class, 'updateStatus'])
        ->name('yeucau.trang-thai');

    Route::resource('yeu-cau', JobRequestController::class)
        ->parameters(['yeu-cau' => 'jobRequest'])
        ->names('yeucau');
});
