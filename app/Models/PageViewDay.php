<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageViewDay extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'view_date',
        'total_views',
        'human_views',
        'bot_views',
        'team_views',
        'unique_visitors',
        'human_uniques',
        'bot_uniques',
        'team_uniques',
    ];

    // LƯU Ý: view_date KHÔNG cast 'date' — nó được tra cứu và lưu đúng
    // chuỗi 'Y-m-d'; cast date của Eloquent lưu kèm giờ 00:00:00 vào
    // SQLite khiến tra cứu theo ngày không khớp.
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_views' => 'integer',
            'human_views' => 'integer',
            'bot_views' => 'integer',
            'team_views' => 'integer',
            'unique_visitors' => 'integer',
            'human_uniques' => 'integer',
            'bot_uniques' => 'integer',
            'team_uniques' => 'integer',
        ];
    }
}
