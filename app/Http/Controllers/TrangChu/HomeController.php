<?php

namespace App\Http\Controllers\TrangChu;

use App\Http\Controllers\Controller;
use App\Models\WorkLedgerEntry;
use Illuminate\Database\Eloquent\Collection;
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
        return view('trangchu.index', $this->ledgerData());
    }

    /**
     * Bản tiếng Anh của trang chủ cho khách quốc tế (mở làn quốc
     * tế 28/10/2026): cùng cấu trúc và cùng sổ công khai, giá tính
     * bằng USD, cách bán demo-trước, đường tiền PayPal / chuyển
     * khoản quốc tế (SWIFT) — tiền vẫn chỉ tính khi đã thật về tay.
     */
    public function en(): View
    {
        return view('trangchu.en', $this->ledgerData());
    }

    /**
     * Dữ liệu sổ công khai dùng chung cho cả hai bản ngôn ngữ:
     * chỉ các dòng "Đã thu" + tổng của chúng.
     *
     * @return array{soCongKhai: Collection<int, WorkLedgerEntry>, tongThu: int}
     */
    private function ledgerData(): array
    {
        $soCongKhai = WorkLedgerEntry::query()
            ->where('status', 'da_thu')
            ->orderByDesc('work_date')
            ->orderByDesc('id')
            ->get();

        return [
            'soCongKhai' => $soCongKhai,
            'tongThu' => (int) $soCongKhai->sum('amount'),
        ];
    }
}
