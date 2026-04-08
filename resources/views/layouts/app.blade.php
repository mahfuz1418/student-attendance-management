<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            background: #1e1e2d;
            min-height: 100vh;
            width: 240px;
            padding: 1.5rem 1rem;
            flex-shrink: 0;
        }

        .sidebar .brand {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            padding: 0 0.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar .brand span {
            color: #7c6ff7;
        }

        .sidebar-divider {
            border-color: #2e2e3e;
            margin: 0.75rem 0;
        }

        .sidebar-label {
            font-size: 11px;
            font-weight: 600;
            color: #6c6c8a;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0 0.75rem;
            margin-bottom: 0.4rem;
        }

        .sidebar .nav-link {
            color: #a0a0c0;
            font-size: 14px;
            padding: 0.55rem 0.75rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.15s, color 0.15s;
        }

        .sidebar .nav-link:hover {
            background: #2a2a3d;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #7c6ff7;
            color: #fff;
        }

        .sidebar .nav-link i {
            font-size: 15px;
            width: 18px;
            text-align: center;
        }

        .user-info {
            background: #2a2a3d;
            border-radius: 10px;
            padding: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .user-info .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #7c6ff7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info .name {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            line-height: 1.2;
        }

        .user-info .role {
            font-size: 11px;
            color: #6c6c8a;
            text-transform: capitalize;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e5e0;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar .page-title {
            font-size: 15px;
            font-weight: 500;
            color: #1a1a1a;
            margin: 0;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8f8f5;
        }
    </style>
</head>
<body>

<div class="d-flex">

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand mb-3">
        <i class="bi bi-check2-circle" style="color: #7c6ff7;"></i>
        Attend<span>Sys</span>
    </div>

    <!-- User Info -->
    <div class="user-info d-flex align-items-center gap-2">
        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="role">{{ ucfirst(auth()->user()->role) }}</div>
        </div>
    </div>

    <hr class="sidebar-divider">

    <ul class="nav flex-column gap-1">

        <!-- Admin Sidebar -->
        @if(auth()->user()->role == 'admin')
            <li class="sidebar-label">Admin</li>

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin') }}" class="nav-link {{ request()->routeIs('admin') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>

            <!-- Manage Users -->
            <li>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manage Users
                </a>
            </li>

            <!-- Manage Courses -->
            <li>
                <a href="{{ route('courses.index') }}" class="nav-link {{ request()->is('courses*') && !request()->is('courses/assign*') ? 'active' : '' }}">
                    <i class="bi bi-journal-bookmark"></i> Manage Courses
                </a>
            </li>

            <!-- Assign Courses (Unified) -->
            <li>
                <a href="{{ route('assign.index') }}" class="nav-link {{ request()->is('courses/assign*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Assign Courses
                </a>
            </li>

            <!-- Attendance Report -->
            <li>
                <a href="/attendance-report" class="nav-link {{ request()->is('attendance-report*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> Attendance Report
                </a>
            </li>
        @endif

        @if(auth()->user()->role == 'teacher')
    <li class="sidebar-label">Teacher</li>

    <!-- Dashboard -->
    <li>
        <a href="{{ route('teacher') }}" class="nav-link {{ request()->routeIs('teacher') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
    </li>

    <!-- Take Attendance -->
    <li>
        <a href="{{ route('teacher.courses') }}" class="nav-link {{ request()->is('take-attendance*') ? 'active' : '' }}">
            <i class="bi bi-pencil-square"></i> Take Attendance
        </a>
    </li>

    <!-- My Classes -->
    <li>
        <a href="/my-classes" class="nav-link {{ request()->is('my-classes*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> My Classes
        </a>
    </li>
@endif

        @if(auth()->user()->role == 'student')
            <li class="sidebar-label">Student</li>

            <!-- Dashboard -->
            <li>
                <a href="/student" class="nav-link {{ request()->is('student') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>

            <!-- My Attendance -->
            <li>
                <a href="/my-attendance" class="nav-link {{ request()->is('my-attendance*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i> My Attendance
                </a>
            </li>
        @endif

    </ul>

    <hr class="sidebar-divider" style="margin-top: auto;">

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button class="btn w-100 nav-link text-start d-flex align-items-center gap-2"
            style="color: #e05a5a; background: transparent; border: none; padding: 0.55rem 0.75rem; border-radius: 8px;">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>
    <!-- Main -->
    <div class="main-content">
        <div class="topbar">
            <p class="page-title">{{ auth()->user()->name }}</p>
            <span style="font-size: 13px; color: #888;">{{ now()->format('D, d M Y') }}</span>
        </div>

        <div class="p-4">
            @yield('content')
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

