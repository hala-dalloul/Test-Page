@extends('layouts.app')

@section('title', 'تفاصيل الموعد')
@section('page-title', 'تفاصيل الموعد')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right me-2"></i>
            العودة
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">تفاصيل الموعد</h5>
                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit me-2"></i>
                    تعديل
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">المريض</h6>
                        <p class="h5">
                            <a href="{{ route('patients.show', $appointment->patient->id) }}">
                                {{ $appointment->patient->user->name }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الطبيب</h6>
                        <p class="h5">{{ $appointment->doctor->name }}</p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">التاريخ والوقت</h6>
                        <p>{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">نوع الموعد</h6>
                        <p>{{ $appointment->getTypeLabel() }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-1">الحالة</h6>
                    <p>
                        <span class="badge bg-{{ $appointment->status === 'completed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : ($appointment->status === 'confirmed' ? 'primary' : 'warning')) }}">
                            {{ $appointment->getStatusLabel() }}
                        </span>
                    </p>
                </div>

                @if($appointment->cancellation_reason)
                    <div class="mb-4">
                        <h6 class="text-muted mb-1">سبب الإلغاء</h6>
                        <p>{{ $appointment->cancellation_reason }}</p>
                    </div>
                @endif

                @if($appointment->notes)
                    <div class="mb-4">
                        <h6 class="text-muted mb-1">ملاحظات</h6>
                        <p>{{ $appointment->notes }}</p>
                    </div>
                @endif

                <hr>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">من قبل</h6>
                        <p>{{ $appointment->createdBy->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">تاريخ الإنشاء</h6>
                        <p>{{ $appointment->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">
                        <i class="fas fa-trash me-2"></i>
                        حذف الموعد
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">معلومات المريض</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">الهاتف</h6>
                    <p>
                        <a href="tel:{{ $appointment->patient->user->phone }}">
                            {{ $appointment->patient->user->phone }}
                        </a>
                    </p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted mb-1">البريد الإلكتروني</h6>
                    <p>
                        <a href="mailto:{{ $appointment->patient->user->email }}">
                            {{ $appointment->patient->user->email }}
                        </a>
                    </p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted mb-1">الهوية الوطنية</h6>
                    <p>{{ $appointment->patient->national_id }}</p>
                </div>
                @if($appointment->patient->blood_type)
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">فئة الدم</h6>
                        <p><span class="badge bg-danger">{{ $appointment->patient->blood_type }}</span></p>
                    </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <a href="{{ route('patients.show', $appointment->patient->id) }}" class="btn btn-sm btn-outline-primary w-100">
                    <i class="fas fa-user me-2"></i>
                    عرض ملف المريض
                </a>
            </div>
        </div>
    </div>
</div>
@endsection