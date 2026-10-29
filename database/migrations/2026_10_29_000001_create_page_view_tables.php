<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Thống kê người xem trang chủ, tự đếm trong hệ thống (port từ
     * becamdilam). Định nghĩa đếm (Billy chốt áp dụng 29/10/2026):
     * TỔNG lượt xem = MỌI lượt mở trang chủ thành công — tính cả bot
     * và cả người đã đăng nhập — vì bot duyệt web thay mặt chủ nhân
     * của nó. Tổng được tách 3 thành phần: người thường / bot (nhận
     * diện thô theo user-agent) / đội nhà (đã đăng nhập). Địa chỉ IP
     * không lưu thô, chỉ lưu bản băm.
     */
    public function up(): void
    {
        Schema::create('page_view_days', function (Blueprint $table) {
            $table->id();
            $table->date('view_date')->unique();
            $table->unsignedInteger('total_views')->default(0);
            $table->unsignedInteger('human_views')->default(0);
            $table->unsignedInteger('bot_views')->default(0);
            $table->unsignedInteger('team_views')->default(0);
            $table->unsignedInteger('unique_visitors')->default(0);
            $table->unsignedInteger('human_uniques')->default(0);
            $table->unsignedInteger('bot_uniques')->default(0);
            $table->unsignedInteger('team_uniques')->default(0);
            $table->timestamps();
        });

        Schema::create('page_view_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('view_date');
            // Băm của (khoá ứng dụng + IP) hoặc (khoá ứng dụng + mã người
            // dùng) đối với đội nhà — không bao giờ lưu IP thô.
            $table->char('visitor_hash', 64);
            $table->string('category', 10);
            $table->timestamps();

            $table->unique(['view_date', 'visitor_hash']);
            $table->index('view_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_view_visitors');
        Schema::dropIfExists('page_view_days');
    }
};
