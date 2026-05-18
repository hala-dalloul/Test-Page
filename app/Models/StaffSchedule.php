<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffSchedule extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    /**
     * Get the staff member associated with this schedule
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get day name in Arabic
     */
    public function getDayName(): string
    {
        $days = [
            0 => 'السبت',
            1 => 'الأحد',
            2 => 'الاثنين',
            3 => 'الثلاثاء',
            4 => 'الأربعاء',
            5 => 'الخميس',
            6 => 'الجمعة',
        ];

        return $days[$this->day_of_week] ?? 'Unknown';
    }

    /**
     * Check if working on given day
     */
    public static function isWorkingOn($userId, $dayOfWeek): bool
    {
        return self::where('user_id', $userId)
                   ->where('day_of_week', $dayOfWeek)
                   ->exists();
    }
}
