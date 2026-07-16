<div class="sidebar">

    <!-- Logo Section -->
    <div class="logo d-flex align-items-center justify-content-between" style="padding: 20px 15px;">
        <div>
            <h4 class="text-white mb-0 fw-bold">TRAKIO</h4>
            <small class="text-muted">Admin Panel</small>
        </div>
        <button class="sidebar-close-btn" id="sidebarClose" style="background: none; border: none; color: #94A3B8; font-size: 24px; cursor: pointer;">
            &times;
        </button>
    </div>

    <!--  Sidebar Navigation Menu -->
    <div class="sidebar-menu">
        
        <!--  MAIN SECTION -->
        <div class="sidebar-heading px-3 mb-2 small text-uppercase fw-bold" style="color: #CBD5E1 !important; letter-spacing: 0.8px; font-size: 11px; opacity: 0.85;">
            ● Main
        </div>
        <ul class="nav flex-column mb-3" style="list-style: none; padding-left: 0;">
            <li class="nav-item px-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-th-large mr-2"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>
        
        <!--  ACADEMIC SETUP -->
        <div class="sidebar-heading px-3 mb-2 small text-uppercase fw-bold" style="color: #CBD5E1 !important; letter-spacing: 0.8px; font-size: 11px; opacity: 0.85;">
            ● Academic Setup
        </div>
        <ul class="nav flex-column mb-3" style="list-style: none; padding-left: 0;">
            <li class="nav-item px-2">
                <a href="{{ route('batches.index') }}" class="nav-link {{ request()->routeIs('batches.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-graduation-cap mr-2"></i> <span>Batches / Semesters</span>
                </a>
            </li>
            <li class="nav-item px-2 mt-1">
                <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-book mr-2"></i> <span>Subjects</span>
                </a>
            </li>
        </ul>

        <!-- USER MANAGEMENT -->
        <div class="sidebar-heading px-3 mb-2 small text-uppercase fw-bold" style="color: #CBD5E1 !important; letter-spacing: 0.8px; font-size: 11px; opacity: 0.85;">
            ● User Management
        </div>
        <ul class="nav flex-column mb-3" style="list-style: none; padding-left: 0;">
            <li class="nav-item px-2">
                <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-chalkboard-teacher mr-2"></i> <span>Teachers</span>
                </a>
            </li>
            <li class="nav-item px-2 mt-1">
                <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-users mr-2"></i> <span>Students</span>
                </a>
            </li>
        </ul>

        <!-- OPERATIONS (Core System Controls) -->
        <div class="sidebar-heading px-3 mb-2 small text-uppercase fw-bold" style="color: #CBD5E1 !important; letter-spacing: 0.8px; font-size: 11px; opacity: 0.85;">
            ● Operations
        </div>
        <ul class="nav flex-column" style="list-style: none; padding-left: 0;">
            <li class="nav-item px-2 mb-1">
                <a href="{{ route('assignments.index') }}" class="nav-link {{ request()->routeIs('assignments.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-link mr-2"></i> <span>Subject Assignments</span>
                </a>
            </li>
            <li class="nav-item px-2 mb-1">
                <a href="{{ route('attendance.index') }}" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-calendar-check mr-2"></i> <span>Attendance</span>
                </a>
            </li>
            
            <!-- Added Performance Warnings Router -->
            <li class="nav-item px-2 mb-3">
                <a href="{{ route('warnings.index') }}" class="nav-link {{ request()->routeIs('warnings.*') ? 'active' : '' }}" style="border-radius: 6px;">
                    <i class="fas fa-triangle-exclamation mr-2"></i> <span>Performance Warnings</span>
                </a>
            </li>

            <!-- Authentication Rules (Logout) -->
            @auth
            <li class="nav-item px-2 mt-2 pt-2" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start d-flex align-items-center" style="padding: 10px 15px; gap: 12px; font-weight: 500; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
            @endauth
        </ul>

    </div>
</div>