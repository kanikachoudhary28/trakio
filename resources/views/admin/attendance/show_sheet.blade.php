@extends('layouts.admin')

@section('content')
<div class="container py-4">
    
    <!-- Top Row Navigation & Meta -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('attendance.by_batch', $subject->batch_id) }}" class="btn btn-sm btn-light border mb-2">
                <i class="fas fa-arrow-left me-1"></i> Back to Logs
            </a>
            <h3 class="text-dark fw-bold mb-0">Attendance Sheet: {{ $subject->subject_name }}</h3>
            <span class="text-muted small">Batch: <strong>{{ $subject->batch->batch_name }}</strong> | Date: <strong>{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</strong></span>
        </div>
    </div>

    <!--Quick Stats Summary Grid -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-white text-center p-3">
                <small class="text-muted d-block text-uppercase fw-semibold" style="font-size: 11px;">Total Strength</small>
                <span class="h4 fw-bold text-dark mb-0">{{ $totalStudents }} Students</span>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-white text-center p-3" style="border-left: 4px solid #198754 !important;">
                <small class="text-success d-block text-uppercase fw-semibold" style="font-size: 11px;">Present</small>
                <span class="h4 fw-bold text-success mb-0">{{ $presentCount }}</span>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-white text-center p-3" style="border-left: 4px solid #dc3545 !important;">
                <small class="text-danger d-block text-uppercase fw-semibold" style="font-size: 11px;">Absent</small>
                <span class="h4 fw-bold text-danger mb-0">{{ $absentCount }}</span>
            </div>
        </div>
    </div>

    <!-- Student Wise Attendance Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small fw-bold text-secondary text-uppercase">
                    <tr>
                        <th class="ps-4" style="width: 20%;">Roll No. / ID</th>
                        <th style="width: 50%;">Student Name</th>
                        <th class="text-center" style="width: 30%;">Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendanceRecords as $record)
                        <tr>
                            <!-- Roll No / Student ID -->
                            <td class="ps-4 fw-mono text-secondary">
                                #{{ $record->student->id ?? 'N/A' }}
                            </td>
                            
                            <!-- Student Name -->
                           
<td class="fw-semibold text-dark">
    {{ $record->student->user->name ?? 'Unknown Student' }} 
                            
                            <!-- Attendance Badge Status -->
                            <td class="text-center">
                                @if(strtolower($record->status) == 'present')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold" style="font-size: 12px; min-width: 90px;">
                                        <i class="fas fa-check me-1"></i> Present
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold" style="font-size: 12px; min-width: 90px;">
                                        <i class="fas fa-times me-1"></i> Absent
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-2 d-block text-secondary"></i>
                                No student breakdown logs available for this sheet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection