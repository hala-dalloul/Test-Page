@extends('layouts.app')

@section('title', 'إدارة الطاقم الطبي')
@section('page-title', 'إدارة الطاقم الطبي')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">
            <i class="fas fa-stethoscope me-2"></i>
            الطاقم الطبي
        </h2>
        <a href="{{ route('staff.create') }}" class="btn btn-primary">
            <i class="fas fa-user-md me-2"></i>
            إضافة موظف جديد
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="البحث بالاسم...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>جميع الأدوار</option>
                    <option>طبيب</option>
                    <option>ممرض</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>الحالة</option>
                    <option>نشط</option>
                    <option>معطل</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Staff Table -->
<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">قائمة الموظفين</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الدور</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>الحالة</th>
                    <th>تاريخ التعيين</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>د. فاطمة علي</strong></td>
                    <td><span class="badge bg-primary">طبيب</span></td>
                    <td>fatima@dental.com</td>
                    <td>+966 50 111 1111</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2025-01-15</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-warning" title="الجدول الزمني">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>د. محمود حسن</strong></td>
                    <td><span class="badge bg-primary">طبيب</span></td>
                    <td>mahmoud@dental.com</td>
                    <td>+966 50 222 2222</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2025-02-10</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-warning" title="الجدول الزمني">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>أم. نهى محمد</strong></td>
                    <td><span class="badge bg-success">ممرضة</span></td>
                    <td>noha@dental.com</td>
                    <td>+966 50 333 3333</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2025-03-01</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-warning" title="الجدول الزمني">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>د. أميرة محمد</strong></td>
                    <td><span class="badge bg-primary">طبيب</span></td>
                    <td>amira@dental.com</td>
                    <td>+966 50 444 4444</td>
                    <td><span class="badge bg-warning">معطل</span></td>
                    <td>2025-01-20</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-warning" title="الجدول الزمني">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection