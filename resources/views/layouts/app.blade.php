<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - نظام إدارة عيادة الأسنان</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    @stack('styles')
</head>
<body class="bg-light">
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-dark text-white p-0 position-fixed h-100">
            <div class="sidebar-header p-4 border-bottom border-secondary">
                <h5 class="mb-0 d-flex align-items-center gap-2">
                    <i class="fas fa-tooth text-primary"></i>
                    <span>DentalCare</span>
                </h5>
                <small class="text-muted">لوحة التحكم</small>
            </div>

            <ul class="nav flex-column p-3 nav-menu" id="navMenu">
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span class="ms-2">الرئيسية</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" 
                       href="{{ route('patients.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="ms-2">المرضى</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" 
                       href="{{ route('appointments.index') }}">
                        <i class="fas fa-calendar-check"></i>
                        <span class="ms-2">المواعيد</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}" 
                       href="{{ route('staff.index') }}">
                        <i class="fas fa-stethoscope"></i>
                        <span class="ms-2">الطاقم الطبي</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i>
                        <span class="ms-2">الإعدادات</span>
                    </a>
                </li>

                <hr class="bg-secondary my-3">

                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="ms-2">تسجيل الخروج</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
                <div class="container-fluid px-4">
                    <button class="btn btn-sm btn-outline-secondary me-3" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <span class="navbar-text d-none d-md-inline">@yield('page-title', 'الرئيسية')</span>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <!-- Search Bar (optional) -->
                        <div class="d-none d-md-flex">
                            <input type="text" class="form-control form-control-sm" placeholder="بحث سريع..." style="width: 250px;">
                        </div>

                        <!-- Notifications -->
                        <button class="btn btn-link position-relative" type="button">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle text-dark text-decoration-none" 
                                    type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle fa-2x"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
                                <li><a class="dropdown-item" href="#">تغيير كلمة المرور</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    تسجيل الخروج
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid p-4">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>خطأ!</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (optional but useful) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
