<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageViewVisitor extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'view_date',
        'visitor_hash',
        'category',
    ];

    // view_date giữ dạng chuỗi 'Y-m-d' (xem ghi chú ở PageViewDay).
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }
}
