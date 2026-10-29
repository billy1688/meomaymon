<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\WorkLedgerEntry;
use App\Support\PageViewCounter;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $tongDaThu = (int) WorkLedgerEntry::query()
            ->where('status', 'da_thu')
            ->sum('amount');

        $soDongSo = WorkLedgerEntry::query()->count();
        $soYeuCauMoi = JobRequest::query()->where('status', 'moi')->count();
        $luotXem = PageViewCounter::summary();

        return view('dashboard', compact('tongDaThu', 'soDongSo', 'soYeuCauMoi', 'luotXem'));
    }
}
