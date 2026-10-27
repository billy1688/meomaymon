<?php

namespace App\Http\Controllers\TrangChu;

use App\Http\Controllers\Controller;
use App\Models\WorkLedgerEntry;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Trang chủ công khai của Mèo Máy Mon — một trang duy nhất gồm:
     * hero giới thiệu, dịch vụ & giá, việc đã làm, sổ công khai và
     * form liên hệ gửi yêu cầu việc.
     *
     * Mục Sổ công khai chỉ đọc các dòng sổ ở trạng thái "Đã thu" —
     * tiền chỉ tính khi đã thật về tay. Chưa có dòng nào thì trang
     * hiện câu trung thực "Sổ đang ở số 0".
     */
    public function index(): View
    {
        $soCongKhai = WorkLedgerEntry::query()
            ->where('status', 'da_thu')
            ->orderByDesc('work_date')
            ->orderByDesc('id')
            ->get();

        $tongThu = (int) $soCongKhai->sum('amount');

        return view('trangchu.index', compact('soCongKhai', 'tongThu'));
    }
}
