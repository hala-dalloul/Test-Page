@extends('layouts.app')

@section('title', 'ملف المريض')
@section('page-title', 'ملف المريض - ' . $patient->user->name)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right me-2"></i>
            العودة
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Patient Info Card -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">معلومات المريض</h5>
                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit me-2"></i>
                    تعديل
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الاسم الكامل</h6>
                        <p class="h5">{{ $patient->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الهوية الوطنية</h6>
                        <p class="h5">{{ $patient->national_id }}</p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">البريد الإلكتروني</h6>
                        <p>{{ $patient->user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">رقم الهاتف</h6>
                        <p>
                            <a href="tel:{{ $patient->user->phone }}">{{ $patient->user->phone }}</a>
                        </p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">تاريخ الميلاد</h6>
                        <p>{{ $patient->date_of_birth->format('d/m/Y') }} ({{ $patient->getAge() }} سنة)</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الجنس</h6>
                        <p>{{ $patient->gender === 'male' ? 'ذكر' : 'أنثى' }}</p>
                    </div>
                </div>

                <hr>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">فئة الدم</h6>
                        <p>
                            @if($patient->blood_type)
                                <span class="badge bg-danger">{{ $patient->blood_type }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الحساسيات</h6>
                        <p>
                            @if($patient->allergies)
                                {{ $patient->allergies }}
                            @else
                                <span class="text-muted">لا توجد حساسيات معروفة</span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($patient->address)
                    <div class="mb-4">
                        <h6 class="text-muted mb-1">العنوان</h6>
                        <p>{{ $patient->address }}</p>
                    </div>
                @endif

                @if($patient->notes)
                    <div class="mb-4">
                        <h6 class="text-muted mb-1">ملاحظات</h6>
                        <p>{{ $patient->notes }}</p>
                    </div>
                @endif

                <hr>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">تاريخ التسجيل</h6>
                        <p>{{ $patient->user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">الحالة</h6>
                        <p>
                            @if($patient->user->is_active)
                                <span class="badge bg-success">نشط</span>
                            @else
                                <span class="badge bg-danger">معطل</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">
                        <i class="fas fa-trash me-2"></i>
                        حذف المريض
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Appointments Card -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-check me-2"></i>
                    المواعيد الأخيرة
                </h5>
            </div>
            <div class="list-group list-group-flush">
                @forelse($patient->appointments->take(5) as $appointment)
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $appointment->doctor->name }}</h6>
                                <small class="text-muted">{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <span class="badge bg-{{ $appointment->status === 'completed' ? 'success' : ($appointment->status === 'cancelled' ? 'danger' : 'primary') }}">
                                {{ $appointment->getStatusLabel() }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="list-group-item text-muted text-center py-4">
                        <i class="fas fa-calendar-times mb-2 fa-2x"></i>
                        <p>لا توجد مواعيد</p>
                    </div>
                @endforelse
            </div>
            <div class="card-footer bg-light">
                <a href="{{ route('appointments.create') . '?patient=' . $patient->id }}" class="btn btn-sm btn-primary w-100">
                    <i class="fas fa-calendar-plus me-2"></i>
                    إنشاء موعد جديد
                </a>
            </div>
        </div>
    </div>
</div>
@endsection