@extends('layouts.admin')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <!-- Breadcrumb & Top Section -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-light border mb-2"><i class="fas fa-arrow-left me-1"></i> Back to Batches</a>
            <h3 class="text-dark fw-bold mb-0">Subjects for: {{ $batch->batch_name }}</h3>
            <span class="text-muted small">Academic Year: {{ $batch->academic_year }}</span>
        </div>
        <a href="{{ route('subjects.create') }}" class="btn btn-success px-4" style="border-radius: 8px;">
            <i class="fas fa-plus me-1"></i> Add Subject
        </a>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small fw-bold text-secondary text-uppercase">
                    <tr>
                        <th class="ps-4">Subject Code</th>
                        <th>Subject Name</th>
                        <th>Assigned Batch</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $subject)
                        <tr>
                            <td class="ps-4 fw-bold text-success">{{ $subject->subject_code }}</td>
                            <td class="fw-semibold text-dark">{{ $subject->subject_name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $batch->batch_name }}</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-light text-primary border shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Do you want to remove this subject?');" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-book-open fa-2x mb-2 d-block text-secondary"></i>
                                No subjects assigned to this batch yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection