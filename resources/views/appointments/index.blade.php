@extends('layouts.app')

@section('title', 'إدارة المواعيد')
@section('page-title', 'إدارة المواعيد')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">
            <i class="fas fa-calendar-check me-2"></i>
            قائمة المواعيد
        </h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus me-2"></i>
            إنشاء موعد جديد
        </a>
    </div>
</div>

<!-- View Toggle -->
<div class="card mb-4">
    <div class="card-body">
        <div class="btn-group" role="group">
            <input type="radio" class="btn-check" name="view" id="listView" checked>
            <label class="btn btn-outline-primary" for="listView">
                <i class="fas fa-list me-2"></i>عرض القائمة
            </label>

            <input type="radio" class="btn-check" name="view" id="calendarView">
            <label class="btn btn-outline-primary" for="calendarView">
                <i class="fas fa-calendar me-2"></i>عرض التقويم
            </label>
        </div>

        <div class="row g-3 mt-3 float-end">
            <div class="col-md-3">
                <input type="date" id="filterDate" class="form-control">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>جميع الأطباء</option>
                    <option>د. فاطمة علي</option>
                    <option>د. محمود حسن</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>جميع الحالات</option>
                    <option>مؤكد</option>
                    <option>قيد الانتظار</option>
                    <option>مكتمل</option>
                    <option>ملغي</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Appointments Table -->
<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">المواعيد المسجلة</h5>
        <div>
            <button class="btn btn-sm btn-outline-secondary" onclick="exportTableToCSV('appointmentsTable', 'appointments.csv')">
                <i class="fas fa-download me-1"></i>تصدير
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="appointmentsTable">
            <thead>
                <tr>
                    <th>الوقت</th>
                    <th>المريض</th>
                    <th>الطبيب</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>الملاحظات</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>09:00 صباحاً</strong></td>
                    <td>أحمد محمد</td>
                    <td>د. فاطمة علي</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td><span class="badge bg-success">مؤكد</span></td>
                    <td>تنظيف الأسنان</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>10:30 صباحاً</strong></td>
                    <td>سارة إبراهيم</td>
                    <td>د. محمود حسن</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td><span class="badge bg-warning">قيد الانتظار</span></td>
                    <td>علاج تسوس</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" title="حذف" onclick="confirmDelete(event)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><strong>2:00 مساءً</strong></td>
                    <td>علي الشريف</td>
                    <td>د. فاطمة علي</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td><span class="badge bg-info">مكتمل</span></td>
                    <td>خلع سن</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-info" title="تعديل">
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
</div>
@endsection