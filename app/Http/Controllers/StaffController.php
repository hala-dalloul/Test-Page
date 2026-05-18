<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StaffSchedule;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StaffController extends Controller
{
    /**
     * Display a listing of staff members
     */
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['doctor', 'nurse']);

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status == 'active');
        }

        $staff = $query->paginate(15);
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating new staff
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'role' => 'required|in:doctor,nurse',
            'specialization' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'join_date' => 'required|date',
            'working_days' => 'nullable|array',
        ]);

        // Create staff user
        $user = User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make('default_password'), // Should be changed by staff
            'role' => $validated['role'],
            'specialization' => $validated['specialization'],
            'qualifications' => $validated['qualifications'],
            'is_active' => true,
        ]);

        // Set working schedule
        if ($request->has('working_days') && $request->working_days) {
            $this->setWorkingSchedule($user->id, $request->working_days);
        }

        return redirect()->route('staff.index')
                        ->with('success', 'تم إضافة الموظف بنجاح');
    }

    /**
     * Display the specified staff member
     */
    public function show(User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $schedule = StaffSchedule::where('user_id', $user->id)->get();
        $attendance = AttendanceLog::where('user_id', $user->id)
                                    ->orderBy('date', 'desc')
                                    ->limit(30)
                                    ->get();

        return view('staff.show', compact('user', 'schedule', 'attendance'));
    }

    /**
     * Show the form for editing the specified staff member
     */
    public function edit(User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }
        return view('staff.edit', compact('user'));
    }

    /**
     * Update the specified staff member
     */
    public function update(Request $request, User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'specialization' => 'nullable|string',
            'qualifications' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'specialization' => $validated['specialization'],
            'qualifications' => $validated['qualifications'],
        ]);

        return redirect()->route('staff.show', $user->id)
                        ->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    /**
     * Toggle staff active status
     */
    public function toggleStatus(User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $user->update(['is_active' => !$user->is_active]);

        $message = $user->is_active ? 'تم تفعيل الموظف' : 'تم تعطيل الموظف';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Show staff schedule
     */
    public function schedule(User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $schedule = StaffSchedule::where('user_id', $user->id)
                                  ->orderBy('day_of_week')
                                  ->get();

        return view('staff.schedule', compact('user', 'schedule'));
    }

    /**
     * Update staff schedule
     */
    public function updateSchedule(Request $request, User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $validated = $request->validate([
            'schedule' => 'required|array',
            'schedule.*.day_of_week' => 'required|integer|between:0,6',
            'schedule.*.start_time' => 'required|date_format:H:i',
            'schedule.*.end_time' => 'required|date_format:H:i|after:schedule.*.start_time',
        ]);

        // Delete existing schedule
        StaffSchedule::where('user_id', $user->id)->delete();

        // Create new schedule
        foreach ($validated['schedule'] as $scheduleItem) {
            StaffSchedule::create([
                'user_id' => $user->id,
                'day_of_week' => $scheduleItem['day_of_week'],
                'start_time' => $scheduleItem['start_time'],
                'end_time' => $scheduleItem['end_time'],
            ]);
        }

        return redirect()->route('staff.schedule', $user->id)
                        ->with('success', 'تم تحديث جدول العمل بنجاح');
    }

    /**
     * View attendance logs
     */
    public function attendance(User $user)
    {
        if (!in_array($user->role, ['doctor', 'nurse'])) {
            abort(404);
        }

        $attendance = AttendanceLog::where('user_id', $user->id)
                                    ->orderBy('date', 'desc')
                                    ->paginate(20);

        return view('staff.attendance', compact('user', 'attendance'));
    }

    /**
     * Helper: Set working schedule for new staff
     */
    private function setWorkingSchedule($userId, $workingDays)
    {
        $daysMapping = [
            'السبت' => 0,
            'الأحد' => 1,
            'الاثنين' => 2,
            'الثلاثاء' => 3,
            'الأربعاء' => 4,
            'الخميس' => 5,
            'الجمعة' => 6,
        ];

        foreach ($workingDays as $day) {
            StaffSchedule::create([
                'user_id' => $userId,
                'day_of_week' => $daysMapping[$day] ?? 0,
                'start_time' => '09:00',
                'end_time' => '17:00',
            ]);
        }
    }
}
