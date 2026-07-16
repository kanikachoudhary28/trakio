@extends('layouts.teacher')

@section('title', 'Early Warning System')

@section('content')
<div class="container-fluid mt-4">
    
    <!-- Top Warning Stats Header -->
    <div class="card border-0 shadow-sm bg-gradient-danger text-white mb-4" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
               <h4 class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-2 animate-pulse"></i> TRAKIO Early Warning Dashboard</h4>
                <p class="mb-0 opacity-80">Students requiring immediate academic attention or attendance counseling are listed below.</p>
            </div>
            <div class="fs-1 fw-bold px-4 py-2 bg-white text-danger rounded-3 shadow-sm">
                {{ count($atRiskStudents) }}
            </div>
        </div>
    </div>

    <!-- Master At-Risk Students Directory Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white p-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-user-shield text-danger me-2"></i> Critical Risk Student List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Roll Number</th>
                            <th>Student Name</th>
                            <th>Class / Batch</th>
                            <th class="text-center">Attendance</th>
                            <th class="text-center">Avg Marks</th>
                            <th>Risk Trigger Reason</th>
                           <th>TRAKIO Action Recommendation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atRiskStudents as $row)
                            <tr style="background-color: rgba(231, 76, 60, 0.02);">
                                <td class="ps-4 fw-bold text-secondary">{{ $row['roll_number'] }}</td>
                                <td class="fw-bold text-dark">{{ $row['name'] }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row['batch_name'] }}</span></td>
                                
                                <!-- Attendance Level Alert Indicator -->
                                <td class="text-center">
                                    <span class="fw-bold {{ $row['attendance'] < 75 ? 'text-danger' : 'text-success' }}">
                                        {{ $row['attendance'] }}%
                                    </span>
                                </td>

                                <!-- Marks Level Alert Indicator -->
                                <td class="text-center">
                                    <span class="fw-bold {{ $row['marks'] !== 'N/A' && $row['marks'] < 40 ? 'text-danger' : 'text-dark' }}">
                                        {{ $row['marks'] }}{{ $row['marks'] !== 'N/A' ? '%' : '' }}
                                    </span>
                                </td>

                                <!-- Trigger Factor Text Flag -->
                                <td>
                                    <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded border border-danger border-opacity-20 small fw-bold">
                                        <i class="fas fa-microchip me-1"></i> {{ $row['reason'] }}
                                    </span>
                                </td>

                                <!-- Automated AI Recommendation Context -->
                                <td>
                                    <div class="small text-secondary fw-semibold">
                                        <i class="far fa-lightbulb text-warning me-1"></i> {{ $row['recommendation'] }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-5 text-muted">
                                    <i class="fas fa-check-circle fa-3x mb-3 d-block text-success"></i>
                                    <h5 class="fw-bold text-success">Excellent! All clear.</h5>
                                    <p class="mb-0 small">No students are currently matching the risk threshold criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}
.animate-pulse { animation: pulse 2s infinite; }
</style>
@endsection