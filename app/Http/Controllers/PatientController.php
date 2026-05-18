<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the patients
     */
    public function index()
    {
        $patients = Patient::with('user')->paginate(15);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new patient
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created patient in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|unique:patients',
            'date_of_birth' => 'required|date',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
            'blood_type' => 'nullable|string',
            'allergies' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Create user account first
        $user = User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make('default_password'), // Admin should change this
            'role' => 'patient',
            'is_active' => true,
        ]);

        // Create patient record
        Patient::create([
            'user_id' => $user->id,
            'national_id' => $validated['national_id'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'blood_type' => $validated['blood_type'],
            'allergies' => $validated['allergies'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('patients.index')
                        ->with('success', 'تم إضافة المريض بنجاح');
    }

    /**
     * Display the specified patient
     */
    public function show(Patient $patient)
    {
        $patient->load('user', 'appointments');
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified patient
     */
    public function edit(Patient $patient)
    {
        $patient->load('user');
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified patient in database
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|unique:patients,national_id,' . $patient->id,
            'date_of_birth' => 'required|date',
            'phone' => 'required|unique:users,phone,' . $patient->user_id,
            'email' => 'required|email|unique:users,email,' . $patient->user_id,
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
            'blood_type' => 'nullable|string',
            'allergies' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Update user
        $patient->user->update([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Update patient
        $patient->update([
            'national_id' => $validated['national_id'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'blood_type' => $validated['blood_type'],
            'allergies' => $validated['allergies'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('patients.show', $patient->id)
                        ->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    /**
     * Soft delete the specified patient
     */
    public function destroy(Patient $patient)
    {
        // Soft delete patient
        $patient->delete();

        // Soft delete associated user
        $patient->user->delete();

        return redirect()->route('patients.index')
                        ->with('success', 'تم حذف المريض بنجاح');
    }
}
