@extends('layouts.app')

@section('title', 'الرئيسية')
@section('page-title', 'لوحة التحكم - الرئيسية')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="h4 mb-0">
            <i class="fas fa-chart-line me-2"></i>
            مرحباً، Admin
        </h2>
        <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <!-- Total Patients -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card stat-card primary">
            <div class="card-body position-relative">
                <i class="fas fa-users stat-icon"></i>
                <h6 class="card-title">إجمالي المرضى</h6>
                <div class="stat-number">245</div>
                <small class="text-success">
                    <i class="fas fa-arrow-up"></i> 12 مريض جديد هذا الشهر
                </small>
            </div>
        </div>
    </div>

    <!-- Today's Appointments -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card stat-card success">
            <div class="card-body position-relative">
                <i class="fas fa-calendar-check stat-icon"></i>
                <h6 class="card-title">مواعيد اليوم</h6>
                <div class="stat-number">8</div>
                <small class="text-success">
                    <i class="fas fa-check-circle"></i> جميعها مؤكدة
                </small>
            </div>
        </div>
    </div>

    <!-- Active Staff -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card stat-card warning">
            <div class="card-body position-relative">
                <i class="fas fa-stethoscope stat-icon"></i>
                <h6 class="card-title">الطاقم النشط</h6>
                <div class="stat-number">12</div>
                <small class="text-warning">
                    <i class="fas fa-user-check"></i> 10 أطباء، 2 ممرض
                </small>
            </div>
        </div>
    </div>

    <!-- Pending Tasks -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card stat-card danger">
            <div class="card-body position-relative">
                <i class="fas fa-tasks stat-icon"></i>
                <h6 class="card-title">المهام المعلقة</h6>
                <div class="stat-number">5</div>
                <small class="text-danger">
                    <i class="fas fa-exclamation-circle"></i> تحتاج إلى اهتمام
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-lightning-bolt me-2"></i>
                    الإجراءات السريعة
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('patients.create') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            إضافة مريض جديد
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('appointments.create') }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-calendar-plus me-2"></i>
                            إنشاء موعد
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('staff.create') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-user-md me-2"></i>
                            إضافة طاقم
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <button class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#reportsModal">
                            <i class="fas fa-chart-bar me-2"></i>
                            تقارير
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Today's Appointments Section -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-day me-2"></i>
                    مواعيد اليوم
                </h5>
                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>الوقت</th>
                            <th>المريض</th>
                            <th>الطبيب</th>
                            <th>الحالة</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>09:00 AM</td>
                            <td>أحمد محمد</td>
                            <td>د. فاطمة علي</td>
                            <td><span class="badge bg-success">مؤكد</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>10:30 AM</td>
                            <td>سارة إبراهيم</td>
                            <td>د. محمود حسن</td>
                            <td><span class="badge bg-warning">قيد الانتظار</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2:00 PM</td>
                            <td>علي الشريف</td>
                            <td>د. فاطمة علي</td>
                            <td><span class="badge bg-info">مكتمل</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3:30 PM</td>
                            <td>هناء عمر</td>
                            <td>د. محمود حسن</td>
                            <td><span class="badge bg-danger">ملغي</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Patients -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-user-clock me-2"></i>
                    أحدث المرضى
                </h5>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">محمود حسن</h6>
                        <small class="text-muted">+966 50 123 4567</small>
                    </div>
                    <small class="text-muted">منذ ساعة</small>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">فاطمة علي</h6>
                        <small class="text-muted">+966 50 234 5678</small>
                    </div>
                    <small class="text-muted">منذ يومين</small>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">سارة إبراهيم</h6>
                        <small class="text-muted">+966 50 345 6789</small>
                    </div>
                    <small class="text-muted">منذ 3 أيام</small>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">علي محمد</h6>
                        <small class="text-muted">+966 50 456 7890</small>
                    </div>
                    <small class="text-muted">منذ أسبوع</small>
                </div>
            </div>
            <div class="card-footer bg-light">
                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary w-100">
                    عرض جميع المرضى
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Calendar and Stats -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-chart-area me-2"></i>
                    إحصائيات المواعيد
                </h5>
            </div>
            <div class="card-body">
                <div id="appointmentsChart" style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 8px;">
                    <small class="text-muted">سيتم عرض الرسم البياني هنا</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    معلومات سريعة
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>نسبة اكتمال المواعيد:</strong>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                    <small class="text-muted">85%</small>
                </div>
                <hr>
                <div class="mb-3">
                    <strong>معدل رضا المرضى:</strong>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: 92%"></div>
                    </div>
                    <small class="text-muted">4.6/5 نجوم</small>
                </div>
                <hr>
                <div>
                    <strong>الأطباء النشطون:</strong>
                    <p class="mb-0 mt-2">
                        <span class="badge bg-success">د. فاطمة علي</span>
                        <span class="badge bg-success">د. محمود حسن</span>
                        <span class="badge bg-success">د. أميرة محمد</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports Modal -->
<div class="modal fade" id="reportsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">التقارير</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-pdf me-2"></i>
                            تقرير المرضى
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-pdf me-2"></i>
                            تقرير المواعيد
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-pdf me-2"></i>
                            تقرير الطاقم
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-pdf me-2"></i>
                            تقرير الإحصائيات
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
