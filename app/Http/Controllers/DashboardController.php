<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard home page
     */
    public function index()
    {
        $statistics = [
            'total_patients' => Patient::count(),
            'today_appointments' => Appointment::whereDate('scheduled_at', today())->count(),
            'active_staff' => User::where('role', '!=', 'patient')->where('is_active', true)->count(),
            'pending_tasks' => 5, // This can be calculated based on your business logic
        ];

        $today_appointments = Appointment::with(['patient', 'doctor'])
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at', 'asc')
            ->limit(4)
            ->get();

        $recent_patients = Patient::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('dashboard.index', compact('statistics', 'today_appointments', 'recent_patients'));
    }
}
