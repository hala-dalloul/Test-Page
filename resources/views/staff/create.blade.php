@extends('layouts.app')

@section('title', 'إضافة موظف جديد')
@section('page-title', 'إضافة موظف جديد')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-user-md me-2"></i>
                    استمارة إضافة موظف جديد
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('staff.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fullName" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullName" name="full_name" required>
                            <div class="invalid-feedback">يرجى إدخال الاسم الكامل</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="role" class="form-label">الدور <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">اختر الدور</option>
                                <option value="doctor">طبيب</option>
                                <option value="nurse">ممرض/ممرضة</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار الدور</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label">الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+966 50 000 0000" required>
                            <div class="invalid-feedback">يرجى إدخال رقم هاتف صحيح</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="specialization" class="form-label">التخصص</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="مثال: تقويم الأسنان">
                    </div>

                    <div class="mb-4">
                        <label for="qualifications" class="form-label">المؤهلات</label>
                        <textarea class="form-control" id="qualifications" name="qualifications" rows="3" placeholder="البكالوريوس، الماجستير، إلخ..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="joinDate" class="form-label">تاريخ التعيين <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="joinDate" name="join_date" required>
                        <div class="invalid-feedback">يرجى إدخال تاريخ التعيين</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">جدول العمل الأسبوعي</label>
                        <div class="card bg-light p-3">
                            <div class="row g-2">
                                @foreach(['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'] as $day)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="{{ $day }}" value="{{ $day }}" name="working_days[]">
                                        <label class="form-check-label" for="{{ $day }}">
                                            {{ $day }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ الموظف
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection