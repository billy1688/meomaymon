<?php

namespace App\Http\Controllers\SoViec;

use App\Http\Controllers\Controller;
use App\Models\WorkLedgerEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WorkLedgerController extends Controller implements HasMiddleware
{
    /**
     * Module Sổ việc ngoài — sổ ghi các việc ngoài Mon nhận làm cho
     * khách. Đúng chuẩn 4 quyền xem/tạo/sửa/xoá. Chỉ các dòng trạng
     * thái "Đã thu" mới hiện ở mục Sổ công khai trên trang chủ.
     *
     * @return list<Middleware>
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:soviec.view', only: ['index']),
            new Middleware('can:soviec.create', only: ['create', 'store']),
            new Middleware('can:soviec.edit', only: ['edit', 'update']),
            new Middleware('can:soviec.delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $entries = WorkLedgerEntry::query()
            ->orderByDesc('work_date')
            ->orderByDesc('id')
            ->paginate(20);

        $tongDaThu = (int) WorkLedgerEntry::query()
            ->where('status', 'da_thu')
            ->sum('amount');

        return view('soviec.index', compact('entries', 'tongDaThu'));
    }

    public function create(): View
    {
        return view('soviec.create', [
            'entry' => new WorkLedgerEntry(['status' => 'chua_thu']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        WorkLedgerEntry::create($this->validateData($request));

        return redirect()
            ->route('admin.soviec.index')
            ->with('success', 'Đã thêm dòng vào sổ việc ngoài.');
    }

    public function edit(WorkLedgerEntry $entry): View
    {
        return view('soviec.edit', compact('entry'));
    }

    public function update(Request $request, WorkLedgerEntry $entry): RedirectResponse
    {
        $entry->update($this->validateData($request));

        return redirect()
            ->route('admin.soviec.index')
            ->with('success', 'Đã cập nhật dòng sổ việc ngoài.');
    }

    public function destroy(WorkLedgerEntry $entry): RedirectResponse
    {
        $entry->delete();

        return redirect()
            ->route('admin.soviec.index')
            ->with('success', 'Đã xoá dòng sổ việc ngoài.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'work_date' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(array_keys(WorkLedgerEntry::STATUSES))],
            'note' => ['nullable', 'string'],
        ]);
    }
}
