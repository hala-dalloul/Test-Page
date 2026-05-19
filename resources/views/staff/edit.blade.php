@extends('layouts.app')

@section('title', 'تعديل الموظف')
@section('page-title', 'تعديل الموظف - ' . $user->name)

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    تعديل بيانات الموظف
                </h5>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('staff.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fullName" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="fullName" name="full_name" value="{{ old('full_name', $user->name) }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label">الهاتف <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="+966 50 000 0000" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="specialization" class="form-label">التخصص</label>
                            <input type="text" class="form-control" id="specialization" name="specialization" placeholder="مثال: تقويم الأسنان" value="{{ old('specialization', $user->specialization) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="qualifications" class="form-label">المؤهلات</label>
                        <textarea class="form-control" id="qualifications" name="qualifications" rows="3" placeholder="البكالوريوس، الماجستير، إلخ...">{{ old('qualifications', $user->qualifications) }}</textarea>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">
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