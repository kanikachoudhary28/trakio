<nav class="navbar-custom">

    <div class="d-flex align-items-center">
        <button class="hamburger-btn me-3" id="sidebarToggle" style="background: none; border: none; font-size: 22px; cursor: pointer;">
            ☰
        </button>
        
        <h5 class="mb-0 fw-bold">
            Dashboard
        </h5>
    </div>

    <div class="d-flex align-items-center gap-3 gap-md-4">

       

        @auth
            <a href="{{ route('student.profile') }}" class="d-flex align-items-center text-decoration-none text-dark profile-hover-nav">

                <div class="avatar p-0 d-flex align-items-center justify-content-center overflow-hidden" style="width: 40px; height: 40px; border-radius: 50%;">
                    @php
                        // Check if student has an uploaded image
                        $navbarStudent = \App\Models\Student::where('user_id', Auth::id())->first();
                    @endphp

                    @if(!empty($navbarStudent->image) && file_exists(public_path($navbarStudent->image)))
                        <img src="{{ asset($navbarStudent->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span class="fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                </div>

                <div class="ms-2 text-start">
                    <span class="nav-link fw-bold mb-0 p-0" style="display: block; line-height: 1.2;">{{ Auth::user()->name }}</span>
                    <small class="text-muted d-block" style="font-size: 11px; margin-top: 2px;">
                        {{ ucfirst(Auth::user()->role) }}
                    </small>
                </div>

            </a>

            <form action="{{ route('logout') }}" method="POST" class="mb-0 d-none d-md-block">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </button>
            </form>
        @else
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </div>
        @endauth

    </div>

</nav>

<style>
    .profile-hover-nav {
        transition: opacity 0.2s ease-in-out;
    }
    .profile-hover-nav:hover {
        opacity: 0.85;
        cursor: pointer;
    }
</style>