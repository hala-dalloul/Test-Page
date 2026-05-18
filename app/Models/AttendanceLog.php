<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceLog extends Model
{
    protected $table = 'attendance_logs';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date',
        'status',
        'created_at',
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
    ];

    /**
     * Get the staff member associated with this log
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get status label in Arabic
     */
    public function getStatusLabel(): string
    {
        $labels = [
            'present' => 'حاضر',
            'absent' => 'غائب',
            'late' => 'متأخر',
            'leave' => 'إجازة',
        ];

        return $labels[$this->status] ?? $this->status;
    }
}
