<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Một dòng trong Sổ việc ngoài.
 *
 * @property int $id
 * @property Carbon $work_date
 * @property string $title
 * @property string|null $client
 * @property int $amount
 * @property string $status
 * @property string|null $note
 */
class WorkLedgerEntry extends Model
{
    /**
     * Trạng thái của một dòng sổ. Chỉ "da_thu" mới hiện công khai
     * và tính vào tổng thu.
     *
     * @var array<string, string>
     */
    public const STATUSES = [
        'chua_thu' => 'Chưa thu',
        'da_thu' => 'Đã thu',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'work_date',
        'title',
        'client',
        'amount',
        'status',
        'note',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'work_date' => 'date',
            'amount' => 'integer',
        ];
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function isReceived(): bool
    {
        return $this->status === 'da_thu';
    }
}
