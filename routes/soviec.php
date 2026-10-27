<?php

use App\Http\Controllers\SoViec\WorkLedgerController;
use Illuminate\Support\Facades\Route;

// Module Sổ việc ngoài — khu backend, bắt buộc đăng nhập.
// Quyền chi tiết (xem/tạo/sửa/xoá) khai trong controller.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('so-viec', WorkLedgerController::class)
        ->except(['show'])
        ->parameters(['so-viec' => 'entry'])
        ->names('soviec');
});
