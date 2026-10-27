<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng yêu cầu việc: khách gửi từ form "Gửi yêu cầu việc" ở trang
     * chủ công khai (hoặc đội nhà thêm tay trong backend). Bảng này chỉ
     * nằm trong backend — không hiển thị ra trang công khai.
     * Trạng thái: moi (mới gửi, chưa xử lý) / da_xu_ly (đã xử lý).
     */
    public function up(): void
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->text('content');
            $table->string('status')->default('moi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_requests');
    }
};
