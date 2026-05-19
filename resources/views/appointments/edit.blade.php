@extends('layouts.app')

@section('title', 'تعديل الموعد')
@section('page-title', 'تعديل الموعد')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-edit me-2"></i>
                    تعديل الموعد
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="patient" class="form-label">المريض <span class="text-danger">*</span></label>
                            <select class="form-select" id="patient" name="patient_id" required>
                                <option value="">اختر مريضاً</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="doctor" class="form-label">الطبيب <span class="text-danger">*</span></label>
                            <select class="form-select" id="doctor" name="doctor_id" required>
                                <option value="">اختر طبيباً</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="date" class="form-label">التاريخ <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="appointment_date" value="{{ old('appointment_date', $appointment->scheduled_at->format('Y-m-d')) }}" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="time" class="form-label">الوقت <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="appointment_time" value="{{ old('appointment_time', $appointment->scheduled_at->format('H:i')) }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label">نوع الموعد <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="appointment_type" required>
                            <option value="">اختر النوع</option>
                            <option value="checkup" {{ old('appointment_type', $appointment->appointment_type) === 'checkup' ? 'selected' : '' }}>فحص عام</option>
                            <option value="cleaning" {{ old('appointment_type', $appointment->appointment_type) === 'cleaning' ? 'selected' : '' }}>تنظيف</option>
                            <option value="treatment" {{ old('appointment_type', $appointment->appointment_type) === 'treatment' ? 'selected' : '' }}>علاج</option>
                            <option value="extraction" {{ old('appointment_type', $appointment->appointment_type) === 'extraction' ? 'selected' : '' }}>خلع</option>
                            <option value="other" {{ old('appointment_type', $appointment->appointment_type) === 'other' ? 'selected' : '' }}>أخرى</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">الحالة <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="scheduled" {{ old('status', $appointment->status) === 'scheduled' ? 'selected' : '' }}>مجدول</option>
                            <option value="confirmed" {{ old('status', $appointment->status) === 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                            <option value="completed" {{ old('status', $appointment->status) === 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ old('status', $appointment->status) === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                    </div>

                    <div class="mb-4" id="cancellation-reason" style="display: none;">
                        <label for="cancellationReason" class="form-label">سبب الإلغاء</label>
                        <textarea class="form-control" id="cancellationReason" name="cancellation_reason" rows="2" placeholder="اذكر السبب">{{ old('cancellation_reason', $appointment->cancellation_reason) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">ملاحظا��</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="ملاحظات إضافية عن الموعد...">{{ old('notes', $appointment->notes) }}</textarea>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('status').addEventListener('change', function() {
        const cancellationReason = document.getElementById('cancellation-reason');
        if (this.value === 'cancelled') {
            cancellationReason.style.display = 'block';
        } else {
            cancellationReason.style.display = 'none';
        }
    });

    // Trigger on page load
    document.getElementById('status').dispatchEvent(new Event('change'));
</script>
@endpush
@endsection