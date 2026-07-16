@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2">
                    Welcome Back, {{ Auth::user()->name }}
                </h2>
                <p class="text-muted mb-0">
                    Track your attendance, academic progress and performance.
                </p>
            </div>
            <div class="text-end">
                <h5 class="text-primary fw-bold mb-0">
                    Student Panel
                </h5>
                <small class="text-muted">
                    TRAKIO Academic Platform
                </small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Attendance Rate</small>
                        <h2 class="fw-bold text-dark mb-1">
                            {{ $attendanceRate }}%
                        </h2>
                        <p class="mb-0 small {{ $attendanceRate < 75 ? 'text-danger fw-bold' : 'text-success' }}">
                            {{ $attendanceRate < 75 ? 'Low Attendance' : 'Excellent' }}
                        </p>
                    </div>
                    <div class="dashboard-icon {{ $attendanceRate < 75 ? 'bg-danger' : 'bg-success' }} text-white d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px;">
                        <i class="fas fa-calendar-check fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Average Marks</small>
                        <h2 class="fw-bold text-dark mb-1">
                            {{ $averageMarks }}%
                        </h2>
                        <p class="mb-0 small {{ $averageMarks < 40 ? 'text-danger fw-bold' : 'text-success' }}">
                            {{ $averageMarks < 40 ? 'Needs Improvement' : 'Good Performance' }}
                        </p>
                    </div>
                    <div class="dashboard-icon bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px;">
                        <i class="fas fa-chart-line fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Subjects</small>
                        <h2 class="fw-bold text-dark mb-1">
                            {{ $totalSubjects }}
                        </h2>
                        <p class="text-primary mb-0 small">
                            Active Courses
                        </p>
                    </div>
                    <div class="dashboard-icon bg-info text-white d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px;">
                        <i class="fas fa-book fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Warnings</small>
                        <h2 class="fw-bold {{ $warningsCount > 0 ? 'text-danger' : 'text-dark' }} mb-1">
                            {{ $warningsCount }}
                        </h2>
                        <p class="mb-0 small {{ $warningsCount > 0 ? 'text-danger fw-bold' : 'text-secondary' }}">
                            {{ $warningsCount > 0 ? 'Needs Attention' : 'All Clear' }}
                        </p>
                    </div>
                    <div class="dashboard-icon {{ $warningsCount > 0 ? 'bg-danger animate-pulse' : 'bg-secondary' }} text-white d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px;">
                        <i class="fas fa-triangle-exclamation fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-poll text-primary me-2"></i> Recent Results
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Subject & Exam</th>
                                <th>Marks Obtained</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentResults as $result)
                                @php
                                    $scorePercentage = $result->max_marks > 0 ? ($result->marks_obtained / $result->max_marks) * 100 : 0;
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold text-dark">{{ $result->subject_name }}</span>
                                        <small class="text-muted d-block">{{ $result->assessment_type }}</small>
                                    </td>
                                    <td class="fw-bold text-primary">
                                        {{ $result->marks_obtained }} <span class="text-muted small">/ {{ $result->max_marks }}</span>
                                    </td>
                                    <td>
                                        @if($scorePercentage >= 75)
                                            <span class="badge bg-success">Excellent</span>
                                        @elseif($scorePercentage < 40)
                                            <span class="badge bg-danger">Fail</span>
                                        @else
                                            <span class="badge bg-primary">Good</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-5 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-2 text-warning d-block"></i>
                                        No exam results published yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-chart-pie text-info me-2"></i> Performance Overview
                </h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span>Attendance Status</span>
                        <span class="badge {{ $attendanceRate >= 75 ? 'bg-success' : 'bg-danger' }}">
                            {{ $attendanceRate >= 90 ? 'Above 90%' : ($attendanceRate >= 75 ? 'Satisfactory' : 'Critical') }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span>Academic Progress</span>
                        <span class="badge {{ $averageMarks >= 40 ? 'bg-primary' : 'bg-danger' }}">
                            {{ $averageMarks >= 75 ? 'Excellent' : ($averageMarks >= 40 ? 'Good' : 'At Risk') }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span>Active System Warnings</span>
                        <span class="badge {{ $warningsCount > 0 ? 'bg-danger' : 'bg-success' }}">
                            {{ $warningsCount }} {{ $warningsCount == 1 ? 'Warning' : 'Warnings' }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <span>Exam Eligibility Status</span>
                        @if($attendanceRate >= 75)
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Eligible</span>
                        @else
                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Detained</span>
                        @endif
                    </li>

                </ul>
            </div>
        </div>
    </div>

</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.08); }
    100% { transform: scale(1); }
}
.animate-pulse { animation: pulse 2s infinite; }
</style>

@endsection