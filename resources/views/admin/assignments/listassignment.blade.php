@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <!-- Success Alert Notification -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 8px;">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Main Table Card Structure -->
    <div class="card border-0 shadow-sm rounded-3">
        <!-- Card Header Section -->
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-link me-2 text-success"></i> Teacher Subject Assignments
            </h5>
            <a href="{{ route('assignments.create') }}" class="btn btn-sm btn-success px-4 rounded-pill d-flex align-items-center gap-2" style="font-weight: 500;">
                <i class="fas fa-plus"></i> Assign New Subject
            </a>
        </div>
        
        <!-- Table Body Section -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-secondary text-uppercase">
                        <tr>
                            <th class="ps-4" style="width: 25%;">Teacher Name</th>
                            <th style="width: 20%;">Assigned Batch</th>
                            <th style="width: 25%;">Subject Name</th>
                            <th style="width: 15%;">Subject Code</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <!-- Teacher Profile (Clean Name - Removed Confusing ID) -->
                                <td class="ps-4">
                                 <div class="fw-semibold text-dark">
        {{ $assignment->teacher->user->name ?? 'N/A' }} 
    </div>
                                    <small class="text-muted text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Faculty</small>
                                </td>
                                
                                <!--Batch Tag -->
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-normal" style="border-radius: 4px;">
                                        {{ $assignment->batch->batch_name ?? 'N/A' }}
                                    </span>
                                </td>
                                
                                <!-- Subject Name -->
                                <td class="fw-semibold text-dark">
                                    {{ $assignment->subject->subject_name ?? 'N/A' }}
                                </td>
                                
                                <!--  Subject Code -->
                                <td>
                                    <span class="fw-bold text-success">{{ $assignment->subject->subject_code ?? 'N/A' }}</span>
                                </td>
                                
                                <!-- Actions Block (Both Edit & Remove Combined Perfectly) -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        
                                        <!-- 📝 Edit Button -->
                                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-sm btn-light text-primary border shadow-sm" title="Edit Assignment" style="padding: 6px 12px; border-radius: 6px; font-size: 13px;">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>

                                       <!-- 🗑️ Remove Form & Button -->
<form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this subject assignment?');" class="mb-0">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm" title="Remove Assignment" style="padding: 6px 12px; border-radius: 6px; font-size: 13px;">
        <i class="fas fa-trash-alt me-1"></i> Remove
    </button>
</form>
                                        
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty State Block -->
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="fas fa-link-slash fa-2x text-secondary"></i></div>
                                    <h6 class="fw-semibold text-secondary mb-1">No Subject Assignments Found</h6>
                                    <p class="small text-muted mb-0">Click 'Assign New Subject' to start allocating faculties.</p>
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