<div class="sidebar">

    <div class="logo d-flex align-items-center justify-content-between">
        <div>
            <h4 class="text-white mb-0 fw-bold">TRAKIO</h4>
            <small class="text-muted">Academic Platform</small>
        </div>
        
        <button class="sidebar-close-btn" id="sidebarClose" style="background: none; border: none; color: #94A3B8; font-size: 24px; cursor: pointer; padding: 0 5px; line-height: 1;">
            &times;
        </button>
    </div>

    <div class="menu-title">
        TEACHER WORKSPACE
    </div>

    <ul class="sidebar-menu d-flex flex-column h-100">

        <li>
            <a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher.students.index') }}" class="{{ request()->routeIs('teacher.students*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                <span>My Students</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher.attendance.select') }}" class="{{ request()->routeIs('teacher.attendance*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher.marks.select') }}" class="{{ request()->routeIs('teacher.marks*') ? 'active' : '' }}">
                <i class="fas fa-edit"></i>
                <span>Marks Entry</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher.performance.index') }}" class="{{ request()->routeIs('teacher.performance*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> <span>Performance</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('teacher.warnings.index') }}" class="{{ request()->routeIs('teacher.warnings*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle"></i> <span>Early Warning</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher.profile.index') }}" class="{{ request()->routeIs('teacher.profile*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i>
                <span>My Profile</span>
            </a>
        </li>

      @auth
<li class="sidebar-logout-li mt-auto">
    <form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
        @csrf
        <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start" style="padding: 12px 15px; display: flex; align-items: center; gap: 12px; font-weight: 500;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </form>
</li>
@endauth

    </ul>

</div>