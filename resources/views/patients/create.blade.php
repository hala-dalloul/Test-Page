@extends('layouts.app')

@section('title', 'إضافة مريض جديد')
@section('page-title', 'إضافة مريض جديد')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    استمارة إضافة مريض جديد
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('patients.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fullName" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullName" name="full_name" required>
                            <div class="invalid-feedback">يرجى إدخال الاسم الكامل</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="nationalId" class="form-label">الهوية الوطنية <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nationalId" name="national_id" required>
                            <div class="invalid-feedback">يرجى إدخال رقم الهوية</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="dob" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dob" name="date_of_birth" required>
                            <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="gender" class="form-label">الجنس <span class="text-danger">*</span></label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">اختر الجنس</option>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار الجنس</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+966 50 000 0000" required>
                            <div class="invalid-feedback">يرجى إدخال رقم هاتف صحيح</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="أي معلومات إضافية..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="bloodType" class="form-label">فئة الدم</label>
                            <select class="form-select" id="bloodType" name="blood_type">
                                <option selected>اختر فئة الدم</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="allergies" class="form-label">الحساسيات</label>
                            <input type="text" class="form-control" id="allergies" name="allergies" placeholder="مثال: البنسلين...">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ المريض
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection