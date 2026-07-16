@extends('layouts.admin')

@section('content')
<div class="container py-4">
    
    <!-- Top Row Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="text-dark fw-bold mb-1"><i class="fas fa-calendar-check text-primary me-2"></i> Institute Attendance Monitoring</h3>
            <p class="text-muted mb-0">Select a specific batch or semester to view and manage detailed daily attendance sheets.</p>
        </div>
        <a href="{{ route('attendance.create') }}" class="btn btn-primary px-4 rounded-pill">
            <i class="fas fa-plus me-1"></i> New Attendance
        </a>
    </div>

    <!-- 🌐 Grid Row for Batches Cards -->
    <div class="row g-4">
        @forelse($batches as $batch)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3" style="border-top: 4px solid #0d6efd !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center rounded-circle" style="width: 45px; height: 45px;">
                                    <i class="fas fa-users" style="font-size: 18px;"></i>
                                </div>
                                <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">
                                    {{ $batch->academic_year }}
                                </span>
                            </div>

                            <h4 class="fw-bold text-dark mb-2">{{ $batch->batch_name }}</h4>
                            <p class="text-muted small">Manage and review filtered historical attendance metrics for this specific class group.</p>
                        </div>

                        <!-- Action Link -->
                        <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                            <a href="{{ route('attendance.by_batch', $batch->id) }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                                View Logs <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted mb-2"><i class="fas fa-folder-open fa-2x"></i></div>
                <h6 class="text-secondary fw-semibold">No Batches Configured Yet.</h6>
            </div>
        @endforelse <!-- ✅ Fixed: directive perfectly matched to endforelse -->
    </div>
</div>
@endsection