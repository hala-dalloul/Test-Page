@extends('layouts.app')

@section('title', 'إدارة المرضى')
@section('page-title', 'إدارة المرضى')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">
            <i class="fas fa-users me-2"></i>
            قائمة المرضى
        </h2>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            إضافة مريض جديد
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="البحث بالاسم أو رقم الهاتف...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>حالة النشاط</option>
                    <option value="1">نشط</option>
                    <option value="2">معطل</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Patients Table -->
<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">المرضى المسجلون</h5>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportTableToCSV('patientsTable', 'patients.csv')">
                <i class="fas fa-download me-1"></i>تصدير
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printTable('patientsTable')">
                <i class="fas fa-print me-1"></i>طباعة
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="patientsTable">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهوية الوطنية</th>
                    <th>تاريخ الميلاد</th>
                    <th>الحالة</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>أحمد محمد علي</strong>
                    </td>
                    <td>+966 50 123 4567</td>
                    <td>ahmed@example.com</td>
                    <td>1234567890</td>
                    <td>1990-05-15</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2026-01-10</td>
                    <td>
                        <a href="{{ route('patients.show', 1) }}" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('patients.edit', 1) }}" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>سارة إبراهيم حسن</strong>
                    </td>
                    <td>+966 50 234 5678</td>
                    <td>sarah@example.com</td>
                    <td>9876543210</td>
                    <td>1992-08-20</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2026-02-15</td>
                    <td>
                        <a href="{{ route('patients.show', 2) }}" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('patients.edit', 2) }}" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>علي محمود حسين</strong>
                    </td>
                    <td>+966 50 345 6789</td>
                    <td>ali@example.com</td>
                    <td>5555555555</td>
                    <td>1988-03-10</td>
                    <td><span class="badge bg-warning">معطل</span></td>
                    <td>2025-12-20</td>
                    <td>
                        <a href="{{ route('patients.show', 3) }}" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('patients.edit', 3) }}" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>فاطمة علي محمد</strong>
                    </td>
                    <td>+966 50 456 7890</td>
                    <td>fatima@example.com</td>
                    <td>7777777777</td>
                    <td>1995-11-25</td>
                    <td><span class="badge bg-success">نشط</span></td>
                    <td>2026-03-05</td>
                    <td>
                        <a href="{{ route('patients.show', 4) }}" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('patients.edit', 4) }}" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-light">
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">السابق</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">التالي</a></li>
            </ul>
        </nav>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', debounce(function(e) {
        filterTable('searchInput', 'patientsTable');
    }, 300));
</script>
@endpush
@endsection