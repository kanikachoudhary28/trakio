@extends('layouts.student')

@section('title', 'My Attendance History')

@section('content')
<div class="container-fluid mt-2">
    
    <!-- Attendance Stats Row -->
    <div class="row g-3 mb-4">
        <!-- Total Classes -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Total Lectures</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $totalDays }}</h4>
                    </div>
                    <div class="bg-light text-primary rounded p-2"><i class="fas fa-list-numeric fa-lg"></i></div>
                </div>
            </div>
        </div>
        <!-- Present Count -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Total Present</small>
                        <h4 class="fw-bold text-success mb-0">{{ $presentDays }}</h4>
                    </div>
                    <div class="bg-light text-success rounded p-2"><i class="fas fa-check fa-lg"></i></div>
                </div>
            </div>
        </div>
        <!-- Absent Count -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Total Absent</small>
                        <h4 class="fw-bold text-danger mb-0">{{ $absentDays }}</h4>
                    </div>
                    <div class="bg-light text-danger rounded p-2"><i class="fas fa-times fa-lg"></i></div>
                </div>
            </div>
        </div>
        <!-- Overall Percentage -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Current Percentage</small>
                        <h4 class="fw-bold {{ $attendanceRate < 75 ? 'text-danger' : 'text-primary' }} mb-0">{{ $attendanceRate }}%</h4>
                    </div>
                    <div class="bg-light text-warning rounded p-2"><i class="fas fa-percentage fa-lg"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Log Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-calendar-alt text-success me-2"></i> Date-Wise Attendance Logs
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 100px;">S.No</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th class="text-center" style="width: 200px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendanceRecords as $index => $record)
                            <tr>
                                <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">
                                    {{ date('d M, Y', strtotime($record->date)) }}
                                </td>
                                <td class="text-secondary">
                                    {{ date('l', strtotime($record->date)) }}
                                </td>
                                <td class="text-center">
                                    @if(strtolower($record->status) == 'present')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Present
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Absent
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-5 text-muted">
                                    <i class="fas fa-calendar-xmark fa-2x mb-2 text-warning d-block"></i>
                                    No attendance records tracked for you yet.
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