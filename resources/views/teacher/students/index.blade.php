@extends('layouts.teacher')

@section('title', 'My Batches')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h4 class="fw-bold text-dark"><i class="fas fa-folder-open text-primary me-2"></i> My Assigned Batches</h4>
    </div>

    <div class="row">
        @forelse($batches as $batch)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #4e73df !important;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="bg-light p-3 rounded-circle text-primary">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                            <span class="badge bg-success px-3 py-2 rounded-pill fs-6">
                                {{ $batch->students_count }} Students
                            </span>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ $batch->batch_name }}</h5>
                        <p class="text-muted small mb-4">Click below to view the complete student directory and contact details.</p>
                        
                        <div class="d-grid">
                            <a href="{{ route('teacher.students.batch', $batch->id) }}" class="btn btn-outline-primary fw-bold btn-sm py-2">
                                <i class="fas fa-eye me-1"></i> View Student List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center p-5 text-muted">
                <i class="fas fa-graduation-cap fa-3x mb-3 text-warning"></i>
                <h5>No batches assigned to you yet.</h5>
            </div>
        @endforelse
    </div>
</div>
@endsection