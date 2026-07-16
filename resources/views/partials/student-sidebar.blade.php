<div class="sidebar">

    <div class="logo d-flex align-items-center justify-content-between">
        <div>
            <h4 class="text-white mb-0 fw-bold">TRAKIO</h4>
            <small class="text-muted">Student Panel</small>
        </div>
        
        <button class="sidebar-close-btn" id="sidebarClose" style="background: none; border: none; color: #94A3B8; font-size: 24px; cursor: pointer; padding: 0 5px; line-height: 1;">
            &times;
        </button>
    </div>

    <div class="menu-title">
        STUDENT WORKSPACE
    </div>

    <ul class="sidebar-menu d-flex flex-column h-100">

        <li>
            <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('student.attendance') }}" class="{{ request()->routeIs('student.attendance*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>

        <li>
            <a href="{{ route('student.results') }}" class="{{ request()->routeIs('student.results*') ? 'active' : '' }}">
                <i class="fas fa-poll"></i>
                <span>Results</span>
            </a>
        </li>

        <li>
            <a href="{{ route('student.performance') }}" class="{{ request()->routeIs('student.performance*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> 
                <span>Performance</span>
            </a>
        </li>

        <li>
            <a href="{{ route('student.warnings') }}" class="{{ request()->routeIs('student.warnings*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i> 
                <span>Warnings</span>
            </a>
        </li>

        <li>
            <a href="{{ route('student.profile') }}" class="{{ request()->routeIs('student.profile*') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
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