@extends('layouts.guest')

@section('title', 'Student Performance System')

@section('content')

<!-- ==========================================
     NAVBAR (Fixed Proportional Spacing)
========================================== -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top py-3 border-bottom" style="border-color: #f1f5f9 !important;">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="/" class="navbar-brand fw-bold text-primary text-uppercase m-0" style="font-size: 24px; letter-spacing: 0.5px; color: #0d6efd !important;">
            TRAKIO
        </a>

        <!-- Middle Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-4">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark px-2" href="#home" style="font-size: 15px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-secondary px-2" href="#features" style="font-size: 15px;">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-secondary px-2" href="#about" style="font-size: 15px;">About</a>
                </li>
            </ul>
        </div>

        <!-- Right Login Button -->
        <div class="d-flex align-items-center">
            <a href="/login" class="btn btn-primary px-4 py-2 fw-semibold text-white shadow-sm" style="background-color: #0d6efd !important; border: none !important; border-radius: 6px !important; font-size: 14px;">
                Login
            </a>
        </div>
    </div>
</nav>

<!-- ==========================================
     HERO SECTION
========================================== -->
<section id="home" class="hero-section d-flex align-items-center" style="padding: 160px 0 90px 0; background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-2 fw-semibold mb-3" style="font-size: 13px; color: #0d6efd !important; background-color: rgba(13, 110, 253, 0.1) !important;">
                    🚀 Next Generation Student Analytics Platform
                </span>

                <h1 class="fw-bold text-dark mt-2 mb-3 display-5" style="line-height: 1.25; font-weight: 800; letter-spacing: -0.5px;">
                    Track Performance.<br>
                    <span class="text-primary" style="color: #0d6efd !important;">Detect Risks Early.</span><br>
                    Improve Student Success.
                </h1>

                <p class="text-muted fs-5 mb-4 fw-normal" style="line-height: 1.6; max-width: 540px;">
                    TRAKIO helps schools and colleges monitor attendance, analyze academic performance and identify at-risk students before problems impact their academic journey.
                </p>

                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 mt-4">
                    <a href="/login" class="btn btn-primary btn-lg px-4 py-3 shadow-sm fw-bold text-white" style="font-size: 15px; background-color: #0d6efd !important; border: none !important; border-radius: 6px !important; min-width: 130px;">
                        Login <i class="fas fa-arrow-right ms-2 small"></i>
                    </a>
                    <a href="#features" class="btn btn-outline-primary btn-lg px-4 py-3 fw-bold" style="font-size: 15px; border-radius: 6px !important; min-width: 150px;">
                        Explore Features
                    </a>
                </div>
            </div>

            <!-- Right Visual Mockup Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow rounded-3 overflow-hidden bg-white p-2 border border-light">
                    <div class="card-header bg-light bg-opacity-50 py-3 px-4 border-0 d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-danger opacity-75" style="width: 8px; height: 8px;"></div>
                            <div class="rounded-circle bg-warning opacity-75" style="width: 8px; height: 8px;"></div>
                            <div class="rounded-circle bg-success opacity-75" style="width: 8px; height: 8px;"></div>
                        </div>
                        <small class="text-muted text-uppercase fw-bold opacity-75" style="font-size: 10px;">Live Analytics Node</small>
                    </div>

                    <div class="card-body p-4 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-secondary small">Average Attendance Rate</span>
                            <strong class="text-success fs-5 fw-bold">92%</strong>
                        </div>

                        <div class="progress mb-4 rounded-3" style="height: 8px; background-color: #f1f5f9;">
                            <div class="progress-bar bg-success" style="width: 92%"></div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-2 border border-light">
                                    <small class="text-muted d-block mb-1 text-uppercase fw-semibold" style="font-size: 10px;">Total Students</small>
                                    <h3 class="fw-bold text-dark mb-0">1,250</h3>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-3 bg-light rounded-2 border border-light">
                                    <small class="text-muted d-block mb-1 text-uppercase fw-semibold" style="font-size: 10px;">Teachers</small>
                                    <h3 class="fw-bold text-dark mb-0">120</h3>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-3 bg-light rounded-2 border border-light">
                                    <small class="text-muted d-block mb-1 text-uppercase fw-semibold" style="font-size: 10px;">Subjects</small>
                                    <h3 class="fw-bold text-dark mb-0">45</h3>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-3 rounded-2 border border-danger-subtle h-100" style="background-color: #fff5f5;">
                                    <small class="text-danger d-block mb-1 text-uppercase fw-bold" style="font-size: 10px;">Warnings Issued</small>
                                    <h3 class="fw-bold text-danger mb-0 d-flex align-items-center justify-content-between">
                                        15 
                                        <span class="badge bg-danger rounded-pill fw-bold" style="font-size: 9px; padding: 4px 8px;">Live</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     FEATURES
========================================== -->
<section id="features" class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-2 fw-semibold mb-2" style="font-size: 12px;">Core Features</span>
            <h2 class="fw-bold text-dark mt-2 display-6">Everything You Need In One Platform</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Powerful tools to monitor, manage and improve student performance efficiently.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Student Management</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Manage student profiles, enrollment data, academic records and performance history from a centralized dashboard.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Attendance Tracking</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Record attendance, monitor trends and identify students with low attendance percentages instantly.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Performance Analytics</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Analyze marks, academic growth and overall student progress using visual insights and reports.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Early Warning System</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Automatically identify students at risk based on attendance and academic performance indicators.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Reports & Insights</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Generate attendance reports, mark sheets and performance summaries with a single click.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 bg-light p-4 h-100 rounded-3 border border-light transition-all hover-shadow">
                    <div class="rounded-2 bg-dark bg-opacity-10 text-dark d-flex align-items-center justify-content-center mb-3" style="width: 44px; height: 44px;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Role Based Access</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Secure access control for Admin, Teachers and Students with dedicated dashboards.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     ABOUT SYSTEM
========================================== -->
<section id="about" class="py-5" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="p-2 bg-white rounded-3 shadow-sm border">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1000" class="img-fluid rounded-2" alt="Students Registry">
                </div>
            </div>

            <div class="col-lg-6">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-2 fw-semibold mb-2" style="font-size: 12px;">Why Choose Trakio</span>
                <h2 class="fw-bold text-dark mt-2 mb-3">Smarter Student Monitoring For Better Academic Results</h2>
                <p class="text-muted mb-4" style="line-height: 1.65;">
                    Trakio helps schools and colleges monitor attendance, academic performance and student engagement in one centralized platform. Institutions can identify struggling students early and take proactive actions before performance declines.
                </p>

                <div class="row g-3 fw-semibold text-secondary" style="font-size: 14px;">
                    <div class="col-sm-6"><i class="fas fa-check-circle text-success me-2"></i> Real-Time Student Analytics</div>
                    <div class="col-sm-6"><i class="fas fa-check-circle text-success me-2"></i> Early Warning Detection</div>
                    <div class="col-sm-6"><i class="fas fa-check-circle text-success me-2"></i> Attendance Monitoring</div>
                    <div class="col-sm-6"><i class="fas fa-check-circle text-success me-2"></i> Performance Reports</div>
                    <div class="col-sm-6"><i class="fas fa-check-circle text-success me-2"></i> Secure Role-Based Access</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     HOW IT WORKS (Fixed Cards Design Layout)
========================================== -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-2 fw-semibold mb-2" style="font-size: 12px;">Simple Process</span>
            <h2 class="fw-bold text-dark mt-2" style="font-size: 32px;">How Trakio Works</h2>
            <p class="text-muted">A simple workflow to monitor and improve student performance.</p>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center bg-light border border-light">
                    <div class="mx-auto rounded-3 bg-white text-primary d-flex align-items-center justify-content-center mb-3 border fw-bold shadow-sm" style="width: 52px; height: 52px; font-size: 16px;">01</div>
                    <h5 class="fw-bold text-dark mb-2">Add Students</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.5;">Register and manage student profiles easily.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center bg-light border border-light">
                    <div class="mx-auto rounded-3 bg-white text-success d-flex align-items-center justify-content-center mb-3 border fw-bold shadow-sm" style="width: 52px; height: 52px; font-size: 16px;">02</div>
                    <h5 class="fw-bold text-dark mb-2">Track Attendance</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.5;">Record attendance daily and monitor trends.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center bg-light border border-light">
                    <div class="mx-auto rounded-3 bg-white text-info d-flex align-items-center justify-content-center mb-3 border fw-bold shadow-sm" style="width: 52px; height: 52px; font-size: 16px;">03</div>
                    <h5 class="fw-bold text-dark mb-2">Analyze Performance</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.5;">Evaluate academic performance through simple reports.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 text-center bg-light border border-light">
                    <div class="mx-auto rounded-3 bg-white text-danger d-flex align-items-center justify-content-center mb-3 border fw-bold shadow-sm" style="width: 52px; height: 52px; font-size: 16px;">04</div>
                    <h5 class="fw-bold text-dark mb-2">Get Alerts</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.5;">Identify at-risk students before issues grow larger.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     TESTIMONIALS
========================================== -->
<section class="py-5 bg-white border-top">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-2 fw-semibold mb-2" style="font-size: 12px;">Testimonials</span>
            <h2 class="fw-bold text-dark mt-2" style="font-size: 32px;">What Users Say About Trakio</h2>
            <p class="text-muted">Feedback from teachers and administrators.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 bg-light h-100 border border-light transition-all hover-shadow">
                    <p class="text-muted small mb-3" style="line-height: 1.65; font-style: italic;">"Trakio helped us identify students with low attendance before their performance dropped."</p>
                    <h6 class="fw-bold text-dark mb-0">Priya Sharma</h6>
                    <small class="text-secondary" style="font-size: 11px;">School Administrator</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 bg-white h-100 border border-light transition-all hover-shadow" style="border-color: rgba(13, 110, 253, 0.2) !important;">
                    <p class="text-muted small mb-3" style="line-height: 1.65; font-style: italic;">"Attendance management and reports became much easier with this system."</p>
                    <h6 class="fw-bold text-dark mb-0">Rahul Verma</h6>
                    <small class="text-secondary" style="font-size: 11px;">Teacher</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 bg-light h-100 border border-light transition-all hover-shadow">
                    <p class="text-muted small mb-3" style="line-height: 1.65; font-style: italic;">"The warning system gives valuable insights about at-risk students."</p>
                    <h6 class="fw-bold text-dark mb-0">Anjali Gupta</h6>
                    <small class="text-secondary" style="font-size: 11px;">Academic Coordinator</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     CTA SECTION (Original Color Unchanged)
========================================== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box shadow-lg rounded-3">
            <h2>Ready To Improve Student Performance?</h2>
            <p>Start monitoring attendance, academic progress and identify at-risk students with Trakio.</p>
            <a href="/login" class="btn btn-light btn-lg px-5 py-3 fw-bold text-primary shadow" style="border-radius: 6px !important; font-size: 14px; min-width: 130px;">
                Login
            </a>
        </div>
    </div>
</section>

<!-- ==========================================
     FOOTER (Strictly Preserved Base Text-Color Elements)
========================================== -->
<footer class="footer-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h3>TRAKIO</h3>
                <p>Smart Student Performance & Early Warning System for modern institutions.</p>
                <div class="mt-3">
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="col-md-2 ms-auto">
                <h5>Quick Links</h5>
                <ul class="ps-0 footer-clean-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5>Modules</h5>
                <ul class="ps-0 text-white-50 opacity-75 list-unstyled d-grid gap-2 small">
                    <li>Students</li>
                    <li>Attendance</li>
                    <li>Marks</li>
                    <li>Reports</li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5>Contact</h5>
                <p class="mb-1">Email: support@trakio.com</p>
                <p>Phone: +91 9876543210</p>
            </div>
        </div>

        <hr>

        <div class="text-center text-white-50 small">
            © 2026 TRAKIO | Student Performance & Early Warning System
        </div>
    </div>
</footer>

<style>
    /* Clean Professional Styling Injections */
    .btn, .custom-radius {
        border-radius: 6px !important; /* Strictly professional soft edge corners */
    }
    
    .footer-clean-links {
        list-style: none;
        padding-left: 0;
        display: grid;
        gap: 8px;
    }
    
    /* 🔥 Overriding blue shift from links in footer section */
    .footer-clean-links li a {
        color: rgba(255, 255, 255, 0.5) !important;
        text-decoration: none !important;
        font-size: 14px;
    }
    
    .footer-clean-links li a:hover {
        color: #ffffff !important;
    }

    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.05)!important;
    }

    .transition-all {
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection