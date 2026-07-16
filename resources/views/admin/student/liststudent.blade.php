@extends('layouts.admin') {{-- Aapka jo bhi master layout ho --}}

@section('content')
<div class="container-fluid py-4" style="background-color: #f8fafc;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold text-dark mb-1">Student Management</h2>
            <p class="text-muted mb-0">Select a semester/batch to view and manage registered students.</p>
        </div>
        <div>
            <a href="{{ route('students.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-user-plus mr-2"></i> Add Student Manually
            </a>
            <a href="{{ route('students.importForm') }}" class="btn btn-success px-4 shadow-sm ml-2">
                <i class="fas fa-file-csv mr-2"></i> Bulk Import CSV
            </a>
        </div>
    </div>

   @if(session('success'))
    <div id="custom-success-alert" class="d-flex justify-content-between align-items-center mb-4 p-3 shadow-sm" 
         style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-radius: 8px; font-weight: 500;">
        
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle mr-2" style="font-size: 1.2rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
        
        <button type="button" onclick="document.getElementById('custom-success-alert').remove();" 
                style="background: none; border: none; color: #0f5132; font-size: 1.4rem; cursor: pointer; line-height: 1; padding: 0 5px; opacity: 0.7;"
                onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">
            &times;
        </button>
    </div>
@endif

    <div class="row">
        @forelse($batches as $batch)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm transition-hover" style="border-radius: 15px; overflow: hidden; border-left: 5px solid #4e73df !important;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="bg-gradient-primary text-white p-3 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4e73df, #224abe);">
                                    <i class="fas fa-graduation-cap fa-lg"></i>
                                </div>
                                <span class="badge badge-light border px-3 py-2 text-dark font-weight-bold" style="border-radius: 20px;">
                                    Academic Year: {{ $batch->academic_year }}
                                </span>
                            </div>

                            <h4 class="card-title font-weight-bold text-dark mb-2">{{ $batch->batch_name }}</h4>
                            <p class="text-muted small mb-4">Click below to manage users, passwords, and export lists.</p>
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center border-top pt-3 mb-3">
                                <span class="text-secondary font-weight-medium">Total Students:</span>
                                <span class="h4 font-weight-bold text-primary mb-0">{{ $batch->students_count }}</span>
                            </div>
                            <a href="{{ route('students.by_batch', $batch->id) }}" class="btn btn-outline-primary btn-block font-weight-bold" style="border-radius: 10px; padding: 10px;">
                                View Student List <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted mb-3"><i class="fas fa-folder-open fa-3x"></i></div>
                <h4 class="text-secondary">No Semesters or Batches Found</h4>
                <p>Please add a batch from the Batch Management section first.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* CSS effect card ko hover karne par lift dene ke liye */
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.1) !important;
        transition: all 0.3s ease-in-out;
    }
    .transition-hover {
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection