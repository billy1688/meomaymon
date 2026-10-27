<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng sổ việc ngoài: mỗi dòng là một việc Mon nhận làm cho khách.
     * Chỉ dòng ở trạng thái "Đã thu" (da_thu) mới hiện lên mục Sổ công
     * khai ở trang chủ và mới tính vào tổng thu — tiền chỉ tính khi đã
     * thật về tay, khớp lệ của trang Mèo Máy Mon.
     */
    public function up(): void
    {
        Schema::create('work_ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->date('work_date');
            $table->string('title');
            $table->string('client')->nullable();
            $table->unsignedBigInteger('amount')->default(0);
            $table->string('status')->default('chua_thu');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_ledger_entries');
    }
};
