<?php

namespace App\Http\Controllers\YeuCau;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobRequestController extends Controller implements HasMiddleware
{
    /**
     * Module Yêu cầu việc — danh sách yêu cầu khách gửi từ form công
     * khai ở trang chủ. Đúng chuẩn 4 quyền xem/tạo/sửa/xoá. "Tạo" chủ
     * yếu đến từ form công khai; backend vẫn có màn thêm tay cho đủ
     * chuẩn module (vd khách liên hệ qua fanpage rồi đội nhà ghi lại).
     * Module chỉ nằm trong backend, không hiện ra trang công khai.
     *
     * @return list<Middleware>
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:yeucau.view', only: ['index', 'show']),
            new Middleware('can:yeucau.create', only: ['create', 'store']),
            new Middleware('can:yeucau.edit', only: ['edit', 'update', 'updateStatus']),
            new Middleware('can:yeucau.delete', only: ['destroy']),
        ];
    }

    public function index(Request $request): View
    {
        $status = $request->query('trang_thai');

        $requests = JobRequest::query()
            ->when(
                is_string($status) && array_key_exists($status, JobRequest::STATUSES),
                fn (Builder $query): Builder => $query->where('status', $status),
            )
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $soYeuCauMoi = JobRequest::query()->where('status', 'moi')->count();

        return view('yeucau.index', compact('requests', 'soYeuCauMoi', 'status'));
    }

    public function show(JobRequest $jobRequest): View
    {
        return view('yeucau.show', compact('jobRequest'));
    }

    public function create(): View
    {
        return view('yeucau.create', [
            'jobRequest' => new JobRequest(['status' => 'moi']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        JobRequest::create($this->validateData($request));

        return redirect()
            ->route('admin.yeucau.index')
            ->with('success', 'Đã thêm yêu cầu việc.');
    }

    public function edit(JobRequest $jobRequest): View
    {
        return view('yeucau.edit', compact('jobRequest'));
    }

    public function update(Request $request, JobRequest $jobRequest): RedirectResponse
    {
        $jobRequest->update($this->validateData($request));

        return redirect()
            ->route('admin.yeucau.index')
            ->with('success', 'Đã cập nhật yêu cầu việc.');
    }

    /**
     * Đánh dấu nhanh đã xử lý / mở lại từ danh sách và trang chi tiết.
     */
    public function updateStatus(Request $request, JobRequest $jobRequest): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(JobRequest::STATUSES))],
        ]);

        $jobRequest->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái yêu cầu việc.');
    }

    public function destroy(JobRequest $jobRequest): RedirectResponse
    {
        $jobRequest->delete();

        return redirect()
            ->route('admin.yeucau.index')
            ->with('success', 'Đã xoá yêu cầu việc.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(array_keys(JobRequest::STATUSES))],
        ]);
    }
}
