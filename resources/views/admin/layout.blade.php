<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            font-size: 14px;
        }
        .sidebar a:hover {
            background-color: #34495e;
            color: #fff;
        }
        .sidebar a.active {
            background-color: #3498db;
            color: #fff;
            border-left: 4px solid #fff;
        }
        .sidebar .menu-title {
            color: #95a5a6;
            font-size: 11px;
            padding: 15px 20px 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar .brand {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px 20px;
            border-bottom: 1px solid #34495e;
            margin-bottom: 10px;
        }
        .main-content { padding: 20px; }
        .navbar-top {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 20px;
        }
        .pagination { justify-content: center; margin-top: 15px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 p-0 sidebar">
           <div class="brand">
    <i class="fas fa-school"></i> {{ \App\Models\Setting::first()->school_name ?? 'Fee System' }}
</div>

            <div class="menu-title">Main</div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <div class="menu-title">Management</div>
            <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard me-2"></i>Classes
            </a>
            <a href="{{ route('sections.index') }}" class="{{ request()->routeIs('sections.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group me-2"></i>Sections
            </a>
            <a href="{{ route('terms.index') }}" class="{{ request()->routeIs('terms.*') ? 'active' : '' }}">
                <i class="fas fa-calendar me-2"></i>Terms
            </a>
            <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate me-2"></i>Students
            </a>

            <div class="menu-title">Fees</div>
            <a href="{{ route('fee_structure.index') }}" class="{{ request()->routeIs('fee_structure.*') ? 'active' : '' }}">
                <i class="fas fa-list me-2"></i>Fee Structure
            </a>
            <a href="{{ route('fee_dues.index') }}" class="{{ request()->routeIs('fee_dues.*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice me-2"></i>Fee Dues
            </a>
            <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill me-2"></i>Payments
            </a>
            <a href="{{ route('receipts.index') }}" class="{{ request()->routeIs('receipts.*') ? 'active' : '' }}">
                <i class="fas fa-receipt me-2"></i>Receipts
            </a>

            <div class="menu-title">Other</div>
            <a href="{{ route('discounts.index') }}" class="{{ request()->routeIs('discounts.*') ? 'active' : '' }}">
                <i class="fas fa-tags me-2"></i>Discounts
            </a>
            <a href="{{ route('fines.index') }}" class="{{ request()->routeIs('fines.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle me-2"></i>Fines
            </a>
            <div class="menu-title">System</div>
<a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
    <i class="fas fa-cog me-2"></i>Settings
</a>
            <div class="menu-title">Account</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <div class="navbar-top d-flex justify-content-between align-items-center">
                <h6 class="mb-0">@yield('page_title', 'Dashboard')</h6>
                <span class="text-muted">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
            <div class="main-content">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>