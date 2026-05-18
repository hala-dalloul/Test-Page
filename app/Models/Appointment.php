<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'scheduled_at',
        'appointment_type',
        'notes',
        'status',
        'cancellation_reason',
        'created_by',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient associated with this appointment
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor associated with this appointment
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the admin who created this appointment
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if appointment is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->scheduled_at->isFuture();
    }

    /**
     * Check if appointment is today
     */
    public function isToday(): bool
    {
        return $this->scheduled_at->isToday();
    }

    /**
     * Check if appointment can be edited
     */
    public function canBeEdited(): bool
    {
        return $this->status === 'scheduled' && $this->isUpcoming();
    }

    /**
     * Check if appointment can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['scheduled', 'confirmed']) && $this->isUpcoming();
    }

    /**
     * Get appointment status label in Arabic
     */
    public function getStatusLabel(): string
    {
        $labels = [
            'scheduled' => 'مجدول',
            'confirmed' => 'مؤكد',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get appointment type label in Arabic
     */
    public function getTypeLabel(): string
    {
        $labels = [
            'checkup' => 'فحص عام',
            'cleaning' => 'تنظيف',
            'treatment' => 'علاج',
            'extraction' => 'خلع',
            'other' => 'أخرى',
        ];

        return $labels[$this->appointment_type] ?? $this->appointment_type;
    }
}
