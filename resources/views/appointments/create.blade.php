@extends('layouts.app')

@section('title', 'إنشاء موعد جديد')
@section('page-title', 'إنشاء موعد جديد')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-plus me-2"></i>
                    استمارة إنشاء موعد جديد
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('appointments.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="patient" class="form-label">اختر المريض <span class="text-danger">*</span></label>
                            <select class="form-select" id="patient" name="patient_id" required>
                                <option value="">اختر مريضاً</option>
                                <option value="1">أحمد محمد</option>
                                <option value="2">سارة إبراهيم</option>
                                <option value="3">علي محمود</option>
                                <option value="4">فاطمة علي</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار مريض</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="doctor" class="form-label">اختر الطبيب <span class="text-danger">*</span></label>
                            <select class="form-select" id="doctor" name="doctor_id" required>
                                <option value="">اختر طبيباً</option>
                                <option value="1">د. فاطمة علي</option>
                                <option value="2">د. محمود حسن</option>
                                <option value="3">د. أميرة محمد</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار طبيب</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="date" class="form-label">تاريخ الموعد <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="appointment_date" required>
                            <div class="invalid-feedback">يرجى إدخال التاريخ</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="time" class="form-label">الوقت <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="appointment_time" required>
                            <div class="invalid-feedback">يرجى إدخال الوقت</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label">نوع الموعد <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="appointment_type" required>
                            <option value="">اختر نوع الموعد</option>
                            <option value="checkup">فحص عام</option>
                            <option value="cleaning">تنظيف</option>
                            <option value="treatment">علاج</option>
                            <option value="extraction">خلع</option>
                            <option value="other">أخرى</option>
                        </select>
                        <div class="invalid-feedback">يرجى اختيار نوع الموعد</div>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="ملاحظات إضافية عن الموعد..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" id="status" name="status">
                            <option value="scheduled">مجدول</option>
                            <option value="confirmed">مؤكد</option>
                            <option value="completed">مكتمل</option>
                            <option value="cancelled">ملغي</option>
                        </select>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ الموعد
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection