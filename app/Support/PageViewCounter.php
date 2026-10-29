<?php

namespace App\Support;

use App\Models\PageViewDay;
use App\Models\PageViewVisitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Bộ đếm lượt xem trang chủ — tự đếm trong hệ thống, không gắn dịch
 * vụ ngoài (port từ becamdilam, Billy chốt áp dụng 29/10/2026; xem
 * docs/modules/thong-ke-luu-luong.md). Định nghĩa đếm:
 *
 * - TỔNG lượt xem = MỌI lượt mở trang chủ thành công, tính cả bot và
 *   cả người đã đăng nhập (đội nhà). Bot duyệt web thay mặt chủ nhân
 *   của nó nên một lượt bot ghé vẫn là một lượt ghé thật.
 * - Tổng được tách 3 thành phần: 'human' (người thường), 'bot' (nhận
 *   diện thô theo user-agent), 'team' (đã đăng nhập).
 * - Khách không trùng trong ngày: mỗi (ngày, khách) chỉ tính 1 lần;
 *   khách được nhận diện bằng bản băm của IP (hoặc của mã người dùng
 *   với đội nhà) trộn khoá ứng dụng — không lưu IP thô.
 * - Đếm hỏng không được làm hỏng trang chủ: mọi lỗi đều được nuốt lại.
 */
class PageViewCounter
{
    public const HUMAN = 'human';

    public const BOT = 'bot';

    public const TEAM = 'team';

    /**
     * Nhận diện bot thô theo user-agent: đủ dùng để tách số liệu đọc
     * cho rõ, không nhằm nhận diện hoàn hảo.
     */
    private const BOT_PATTERN = '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|facebot|twitterbot|linkedinbot|telegrambot|discordbot|whatsapp|googlebot|bingbot|yandex|baiduspider|duckduckbot|ahrefs|semrush|mj12bot|dotbot|petalbot|bytespider|gptbot|claudebot|ccbot|amazonbot|applebot|meta-externalagent|headless|phantomjs|selenium|puppeteer|scrapy|curl|wget|python-requests|python-urllib|go-http-client|okhttp|java\/|libwww|httpclient|node-fetch|axios|lighthouse/i';

    public static function classify(Request $request): string
    {
        if ($request->user() !== null) {
            return self::TEAM;
        }

        $userAgent = (string) $request->userAgent();

        if ($userAgent === '' || preg_match(self::BOT_PATTERN, $userAgent) === 1) {
            return self::BOT;
        }

        return self::HUMAN;
    }

    /**
     * Ghi một lượt mở trang chủ. Gọi ở đầu HomeController@index và
     * HomeController@en — cả hai bản ngôn ngữ đếm chung một sổ.
     */
    public static function record(Request $request): void
    {
        try {
            $category = self::classify($request);
            $today = now(self::timezone())->toDateString();
            $visitorHash = self::visitorHash($request, $category);

            DB::transaction(function () use ($category, $today, $visitorHash): void {
                $day = PageViewDay::query()->firstOrCreate(['view_date' => $today]);

                $day->increment('total_views');
                $day->increment($category.'_views');

                $inserted = PageViewVisitor::query()->insertOrIgnore([
                    'view_date' => $today,
                    'visitor_hash' => $visitorHash,
                    'category' => $category,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($inserted === 1) {
                    $day->increment('unique_visitors');
                    $day->increment($category.'_uniques');
                }
            });
        } catch (Throwable) {
            // Thống kê là phụ — lỗi đếm không bao giờ làm sập trang chủ.
        }
    }

    /**
     * Số liệu tổng hợp cho thẻ backend và dòng công khai ở trang chủ.
     * totalUniques = cộng dồn khách không trùng của từng ngày (một
     * khách ghé nhiều ngày được tính ở mỗi ngày một lần).
     *
     * @return array{today: array<string, int>, totalViews: int, totalUniques: int}
     */
    public static function summary(): array
    {
        $zeros = [
            'total_views' => 0,
            'human_views' => 0,
            'bot_views' => 0,
            'team_views' => 0,
            'unique_visitors' => 0,
            'human_uniques' => 0,
            'bot_uniques' => 0,
            'team_uniques' => 0,
        ];

        try {
            $todayRow = PageViewDay::query()
                ->where('view_date', now(self::timezone())->toDateString())
                ->first();

            $today = $zeros;
            if ($todayRow !== null) {
                foreach (array_keys($zeros) as $key) {
                    $today[$key] = (int) $todayRow->{$key};
                }
            }

            return [
                'today' => $today,
                'totalViews' => (int) PageViewDay::query()->sum('total_views'),
                'totalUniques' => (int) PageViewDay::query()->sum('unique_visitors'),
            ];
        } catch (Throwable) {
            return ['today' => $zeros, 'totalViews' => 0, 'totalUniques' => 0];
        }
    }

    /**
     * Múi giờ tính "ngày" của bộ đếm: theo cấu hình ứng dụng (mặc
     * định Asia/Saigon trong config/app.php).
     */
    private static function timezone(): string
    {
        return (string) config('app.timezone', 'Asia/Saigon');
    }

    private static function visitorHash(Request $request, string $category): string
    {
        $key = (string) config('app.key');
        $user = $request->user();

        if ($category === self::TEAM && $user !== null) {
            return hash('sha256', $key.'|user:'.$user->getAuthIdentifier());
        }

        return hash('sha256', $key.'|ip:'.(string) $request->ip());
    }
}
