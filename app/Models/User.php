<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'specialization',
        'qualifications',
        'is_active',
        'profile_photo_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the patient associated with this user
     */
    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * Get the appointments for this doctor
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * Get the schedule for this staff member
     */
    public function schedule(): HasMany
    {
        return $this->hasMany(StaffSchedule::class);
    }

    /**
     * Get the attendance logs for this user
     */
    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is doctor
     */
    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    /**
     * Check if user is nurse
     */
    public function isNurse(): bool
    {
        return $this->role === 'nurse';
    }

    /**
     * Check if user is patient
     */
    public function isPatient(): bool
    {
        return $this->role === 'patient';
    }

    /**
     * Get role label in Arabic
     */
    public function getRoleLabel(): string
    {
        $labels = [
            'admin' => 'مدير',
            'doctor' => 'طبيب',
            'nurse' => 'ممرض/ممرضة',
            'patient' => 'مريض',
        ];

        return $labels[$this->role] ?? $this->role;
    }

    /**
     * Get today's appointments count
     */
    public function getTodayAppointmentsCount(): int
    {
        return $this->appointments()
                    ->whereDate('scheduled_at', today())
                    ->count();
    }
}
