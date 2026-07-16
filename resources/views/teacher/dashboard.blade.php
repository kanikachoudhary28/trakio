@extends('layouts.teacher')

@section('title','Teacher Dashboard')

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2">Welcome Back, {{ Auth::user()->name }}</h2>
                <p class="text-muted mb-0">Manage attendance, marks and student performance from one place.</p>
            </div>
            <div class="text-end">
                <h5 class="text-primary fw-bold">Teacher Panel</h5>
                <small class="text-muted">TRAKIO Academic Platform</small>
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
                        <small class="text-muted">My Students</small>
                        <h2 class="fw-bold mt-2">{{ $totalStudents ?? 0 }}</h2>
                        <p class="text-success mb-0">+0 this semester</p>
                    </div>
                    <div class="dashboard-icon bg-primary text-white p-3 rounded">
                        <i class="fas fa-user-graduate"></i>
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
                        <small class="text-muted">Assigned Batches</small>
                        <h2 class="fw-bold mt-2">{{ $assignedBatchesCount ?? 0 }}</h2>
                        <p class="text-success mb-0">Active Classes</p>
                    </div>
                    <div class="dashboard-icon bg-success text-white p-3 rounded">
                        <i class="fas fa-calendar-check"></i>
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
                        <small class="text-muted">Pending Marks</small>
                        <h2 class="fw-bold mt-2">{{$pendingMarks}}</h2>
                        <p class="text-warning mb-0">Requires attention</p>
                    </div>
                    <div class="dashboard-icon bg-warning text-white p-3 rounded">
                        <i class="fas fa-file-pen"></i>
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
                        <small class="text-muted">At-Risk Students</small>
                        <h2 class="fw-bold text-danger mt-2">{{ $atRiskCount ?? 0 }}</h2>
                        <p class="text-danger mb-0">Review needed</p>
                    </div>
                    <div class="dashboard-icon bg-danger text-white p-3 rounded">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">My Batches & Classes</h5>
            </div>
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Batch Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

@forelse($batches as $batch)
            <tr>
                <td class="fw-bold text-dark">{{ $batch->batch_name }}</td>
                <td>
                    <span class="badge bg-success">Active</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center text-muted">No active batches assigned.</td>
            </tr>
        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">Today's Tasks</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check text-muted me-2"></i> Mark Attendance</li>
                    <li class="list-group-item"><i class="fas fa-check text-muted me-2"></i> Upload Mid-Term Marks</li>
                    <li class="list-group-item"><i class="fas fa-check text-muted me-2"></i> Review Warning Students</li>
                    <li class="list-group-item"><i class="fas fa-check text-muted me-2"></i> Generate Progress Report</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection