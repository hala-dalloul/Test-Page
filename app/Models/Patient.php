<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'national_id',
        'date_of_birth',
        'gender',
        'address',
        'blood_type',
        'allergies',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the user associated with this patient
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointments for this patient
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get patient's full name from user
     */
    public function getName(): string
    {
        return $this->user->name ?? 'Unknown';
    }

    /**
     * Get patient's email from user
     */
    public function getEmail(): string
    {
        return $this->user->email ?? 'N/A';
    }

    /**
     * Get patient's phone from user
     */
    public function getPhone(): string
    {
        return $this->user->phone ?? 'N/A';
    }

    /**
     * Calculate patient's age
     */
    public function getAge(): int
    {
        return $this->date_of_birth->diffInYears(now());
    }

    /**
     * Check if patient is active
     */
    public function isActive(): bool
    {
        return $this->user->is_active ?? false;
    }
}
