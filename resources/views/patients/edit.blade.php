@extends('layouts.app')

@section('title', 'تعديل المريض')
@section('page-title', 'تعديل المريض - ' . $patient->user->name)

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    تعديل بيانات المريض
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fullName" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="fullName" name="full_name" value="{{ old('full_name', $patient->user->name) }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="nationalId" class="form-label">الهوية الوطنية <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="nationalId" name="national_id" value="{{ old('national_id', $patient->national_id) }}" required>
                            @error('national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="dob" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="dob" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth->format('Y-m-d')) }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="gender" class="form-label">الجنس <span class="text-danger">*</span></label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">اختر الجنس</option>
                                <option value="male" {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="+966 50 000 0000" value="{{ old('phone', $patient->user->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $patient->user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $patient->address) }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="bloodType" class="form-label">فئة الدم</label>
                            <select class="form-select" id="bloodType" name="blood_type">
                                <option value="">اختر فئة الدم</option>
                                @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $type)
                                    <option value="{{ $type }}" {{ old('blood_type', $patient->blood_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="allergies" class="form-label">الحساسيات</label>
                            <input type="text" class="form-control" id="allergies" name="allergies" placeholder="مثال: البنسلين..." value="{{ old('allergies', $patient->allergies) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="أي معلومات إضافية...">{{ old('notes', $patient->notes) }}</textarea>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-secondary">
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
@endsection