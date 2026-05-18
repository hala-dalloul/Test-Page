<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['patient.user', 'doctor']);

        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('scheduled_at', $request->date);
        }

        // Filter by doctor
        if ($request->has('doctor_id') && $request->doctor_id) {
            $query->where('doctor_id', $request->doctor_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $appointments = $query->orderBy('scheduled_at', 'desc')->paginate(15);
        $doctors = User::where('role', 'doctor')->where('is_active', true)->get();

        return view('appointments.index', compact('appointments', 'doctors'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors = User::where('role', 'doctor')->where('is_active', true)->get();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created appointment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'appointment_type' => 'required|in:checkup,cleaning,treatment,extraction,other',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,confirmed,completed,cancelled',
        ]);

        // Combine date and time
        $scheduled_at = $validated['appointment_date'] . ' ' . $validated['appointment_time'];

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'scheduled_at' => $scheduled_at,
            'appointment_type' => $validated['appointment_type'],
            'notes' => $validated['notes'],
            'status' => $validated['status'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('appointments.index')
                        ->with('success', 'تم إنشاء الموعد بنجاح');
    }

    /**
     * Display the specified appointment
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor']);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment
     */
    public function edit(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor']);
        $patients = Patient::with('user')->get();
        $doctors = User::where('role', 'doctor')->where('is_active', true)->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    /**
     * Update the specified appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'appointment_type' => 'required|in:checkup,cleaning,treatment,extraction,other',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,confirmed,completed,cancelled',
            'cancellation_reason' => 'nullable|string',
        ]);

        $scheduled_at = $validated['appointment_date'] . ' ' . $validated['appointment_time'];

        $appointment->update([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'scheduled_at' => $scheduled_at,
            'appointment_type' => $validated['appointment_type'],
            'notes' => $validated['notes'],
            'status' => $validated['status'],
            'cancellation_reason' => $validated['cancellation_reason'],
        ]);

        return redirect()->route('appointments.show', $appointment->id)
                        ->with('success', 'تم تحديث الموعد بنجاح');
    }

    /**
     * Delete the specified appointment
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
                        ->with('success', 'تم حذف الموعد بنجاح');
    }
}
