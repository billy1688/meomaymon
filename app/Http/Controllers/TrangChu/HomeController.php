<?php

namespace App\Http\Controllers\TrangChu;

use App\Http\Controllers\Controller;
use App\Models\WorkLedgerEntry;
use App\Support\PageViewCounter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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
    public function index(Request $request): View
    {
        return view('trangchu.index', $this->pageData($request));
    }

    /**
     * Bản tiếng Anh của trang chủ cho khách quốc tế (mở làn quốc
     * tế 28/10/2026): cùng cấu trúc và cùng sổ công khai, giá tính
     * bằng USD, cách bán demo-trước, đường tiền PayPal / chuyển
     * khoản quốc tế (SWIFT) — tiền vẫn chỉ tính khi đã thật về tay.
     */
    public function en(Request $request): View
    {
        return view('trangchu.en', $this->pageData($request));
    }

    /**
     * Dữ liệu chung của trang chủ: sổ công khai + tổng lượt ghé thăm.
     * Lượt ghé được đếm TRƯỚC khi đọc tổng để dòng công khai gồm cả
     * chính lượt ghé này; cả hai bản ngôn ngữ đếm chung một sổ
     * (App\Support\PageViewCounter).
     *
     * @return array{soCongKhai: Collection<int, WorkLedgerEntry>, tongThu: int, tongLuotXem: int}
     */
    private function pageData(Request $request): array
    {
        PageViewCounter::record($request);

        return [
            ...$this->ledgerData(),
            'tongLuotXem' => PageViewCounter::summary()['totalViews'],
        ];
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
