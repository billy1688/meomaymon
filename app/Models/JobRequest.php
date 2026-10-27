<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Một yêu cầu việc khách gửi từ form công khai ở trang chủ
 * (hoặc đội nhà thêm tay trong backend). Chỉ nằm trong backend.
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $content
 * @property string $status
 */
class JobRequest extends Model
{
    /**
     * @var array<string, string>
     */
    public const STATUSES = [
        'moi' => 'Mới',
        'da_xu_ly' => 'Đã xử lý',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'contact',
        'content',
        'status',
    ];

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function isHandled(): bool
    {
        return $this->status === 'da_xu_ly';
    }
}
