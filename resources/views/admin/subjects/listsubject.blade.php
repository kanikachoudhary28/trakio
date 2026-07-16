@extends('layouts.admin')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <!-- Top Heading Row -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="text-dark fw-bold mb-1">Subject Management</h3>
            <p class="text-muted mb-0">Select a semester/batch to view and manage assigned subjects.</p>
        </div>
        <!-- Add New Subject Button -->
        <a href="{{ route('subjects.create') }}" class="btn btn-success px-4 d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 500;">
            <i class="fas fa-plus"></i> Add New Subject
        </a>
    </div>

    <!-- Grid Row for Batches Cards -->
    <div class="row g-4">
        @forelse($batches as $batch)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-3 position-relative" style="border-left: 5px solid #0d6efd !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        
                        <div>
                            <!-- Batch Icon & Academic Year Tag -->
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-book-open" style="font-size: 20px;"></i>
                                </div>
                                <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">
                                    Academic Year: {{ $batch->academic_year }}
                                </span>
                            </div>

                            <!-- Batch Title -->
                            <h4 class="fw-bold text-dark mb-2">{{ $batch->batch_name }}</h4>
                            <p class="text-muted small">Click below to manage subjects, course codes, and curriculum parameters.</p>
                        </div>

                        <!-- Bottom Counter & Action Button -->
                        <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block">Total Subjects:</small>
                                <span class="h4 fw-bold text-primary mb-0">{{ $batch->subjects_count }}</span>
                            </div>
                            
                            <!-- Redirects to specific batch subjects list -->
                            <a href="{{ route('subjects.by_batch', $batch->id) }}" class="btn btn-sm btn-outline-primary px-3 d-flex align-items-center gap-1" style="border-radius: 6px;">
                                View Subject List <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted mb-3"><i class="fas fa-folder-open fa-3x"></i></div>
                <h5 class="text-secondary fw-semibold">No Batches available for Subject Setup.</h5>
                <p class="text-muted small">Create a batch first under Academic Setup.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection