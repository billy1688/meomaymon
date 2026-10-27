<?php

namespace App\Http\Controllers\YeuCau;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PublicJobRequestController extends Controller
{
    /**
     * Nhận yêu cầu việc từ form "Gửi yêu cầu việc" ở mục Liên hệ của
     * trang chủ công khai. Yêu cầu vào backend ở trạng thái "Mới" —
     * không hiện lại ra trang công khai.
     *
     * Chống spam hai lớp (theo mẫu form góp ý của dự án gốc):
     * - Ô bẫy honeypot "website" (người thật không nhìn thấy, bot điền
     *   bừa sẽ dính): dính bẫy thì giả vờ thành công, không lưu gì.
     * - Giới hạn tần suất theo IP: tối đa 5 lần gửi trong 10 phút.
     */
    public function store(Request $request): RedirectResponse
    {
        $home = redirect()->to(rtrim(route('home'), '/').'/#lien-he');

        if (filled($request->input('website'))) {
            return $home->with('yeu_cau_thanh_cong', 'Mon đã nhận yêu cầu, sẽ phản hồi qua cách liên hệ bạn để lại.');
        }

        $rateKey = 'gui-yeu-cau:'.(string) $request->ip();

        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return $home
                ->withErrors(['content' => 'Bạn gửi hơi nhiều yêu cầu trong thời gian ngắn. Nghỉ tay một chút rồi gửi tiếp nhé.'])
                ->withInput();
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:5', 'max:5000'],
        ]);

        RateLimiter::hit($rateKey, 600);

        JobRequest::create([
            'name' => trim($data['name']),
            'contact' => trim($data['contact']),
            'content' => trim($data['content']),
            'status' => 'moi',
        ]);

        return $home->with('yeu_cau_thanh_cong', 'Mon đã nhận yêu cầu, sẽ phản hồi qua cách liên hệ bạn để lại.');
    }
}
