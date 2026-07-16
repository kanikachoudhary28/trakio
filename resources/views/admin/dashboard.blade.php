@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">

    <!-- Top Row Title & Navigation Buttons -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
            <p class="text-muted mb-0">Welcome back! Here's what's happening today.</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('students.importForm') }}" class="btn btn-sm btn-success px-4 py-2 rounded-pill shadow-sm fw-medium d-flex align-items-center border-0" style="background-color: #198754;">
                <i class="fas fa-file-excel me-2"></i> Import Students (CSV)
            </a>
            <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary px-4 py-2 rounded-pill shadow-sm fw-medium d-flex align-items-center border-0" style="background-color: #0d6efd;">
                <i class="fas fa-plus me-2 small"></i> Add Student
            </a>
        </div>
    </div>

    <!--Row 1: Top Core Insight Counters -->
    <div class="row g-3 mb-4">
        <!-- Total Students -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing: 0.5px;">Total Students</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalStudents }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-user-graduate fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing: 0.5px;">Teachers</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalTeachers }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-chalkboard-teacher fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing: 0.5px;">Subjects</p>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalSubjects }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-book fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Warnings -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3" style="border-top: 3px solid #dc3545 !important;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-danger small text-uppercase fw-semibold mb-1" style="letter-spacing: 0.5px;">Active Warnings</p>
                        <h3 class="fw-bold text-danger mb-0">{{ $totalWarnings }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fas fa-triangle-exclamation fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Analytics Graph & Modernized Quick Stats Panel -->
    <div class="row g-4 mb-4">
        <!-- Attendance Analytics Chart Card -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-chart-line text-primary me-2"></i> Attendance Analytics</h5>
                    <span class="badge bg-light text-secondary border small fw-normal">Weekly View</span>
                </div>
                <div class="card-body p-3">
                    <div style="height: 320px; width: 100%; position: relative;">
                        <canvas id="dashboardAttendanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Clean Quick Stats Block -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-gauge-high text-secondary me-2"></i> Core Indicators</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-secondary small">General Attendance Rate</span>
                            <strong class="text-primary fs-5">{{ $attendanceRate }}%</strong>
                        </div>
                        <div class="progress mb-4" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: {{ $attendanceRate }}%"></div>
                        </div>
                    </div>

                    <div class="d-grid gap-3">
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border-start border-success border-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-check text-success me-3"></i>
                                <span class="small fw-semibold text-dark">Passing Students</span>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-bold">{{ $passingStudents }}</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border-start border-danger border-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-xmark text-danger me-3"></i>
                                <span class="small fw-semibold text-dark">At Risk Status</span>
                            </div>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill fw-bold">{{ $atRiskCount }}</span>
                        </div>
                    </div>

                    <div class="mt-4 p-2 bg-light rounded text-center border">
                        <small class="text-muted small" style="font-size: 11px;"><i class="fas fa-circle-info me-1"></i> Data synced in real-time metrics.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Premium Redesigned Recent Registered Students Block -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-user-clock text-secondary me-2"></i> Recent Registered Students
            </h5>
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm" style="font-size: 13px; font-weight: 500;">
                View All <i class="fas fa-arrow-right ms-1 small"></i>
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-secondary text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">
                        <tr>
                            <th class="ps-4" style="width: 40%;">Student Profile</th>
                            <th style="width: 35%;">Batch / Semester</th>
                            <th class="text-center" style="width: 25%;">System Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentStudents as $student)
                            <tr>
                              
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase border" style="width: 36px; height: 36px; font-size: 14px; background-color: #f8f9fa !important;">
                                            {{ substr($student->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <div class="ms-3">
                                            <div class="fw-semibold text-dark text-capitalize" style="font-size: 14px;">
                                                {{ $student->user->name ?? 'N/A' }}
                                            </div>
                                            <small class="text-muted" style="font-size: 11px;">ID: #{{ $student->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                
                               
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-normal" style="border-radius: 4px; font-size: 12px;">
                                        {{ $batch->batch_name ?? $student->batch->batch_name ?? 'N/A' }}
                                    </span>
                                </td>
                                
                           
                                <td class="text-center">
                                    @if(isset($student->warnings_count) && $student->warnings_count > 0)
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px; letter-spacing: 0.3px;">
                                            <i class="fas fa-circle-exclamation me-1"></i> At Risk
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-semibold" style="font-size: 11px; letter-spacing: 0.3px;">
                                            <i class="fas fa-check-circle me-1"></i> Good Standing
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash fa-2x text-secondary mb-2 d-block"></i>
                                    <span class="small">No recent student logs recorded in the registry yet.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection