@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0 text-dark fw-semibold">
                <i class="fas fa-user-tie text-primary me-2"></i> Teacher Management
            </h5>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-medium">
                <i class="fas fa-plus me-1"></i> Add New Teacher
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small fw-bold text-uppercase">
                        <tr>
                            <th class="ps-4">Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Joined Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($teachers as $teacher)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $teacher->user->name ?? 'N/A' }}</td>
                                
                                <td class="text-muted">{{ $teacher->user->email ?? 'N/A' }}</td>
                                
                                <td>{{ $teacher->phone ?? '—' }}</td>
                                
                                <td>
                                    <span class="badge bg-light text-primary border px-2 py-1.5 rounded-pill fw-medium">
                                        {{ $teacher->designation ?? 'Not Specified' }}
                                    </span>
                                </td>
                                
                                <td class="text-muted small">{{ $teacher->created_at->format('d M, Y') }}</td>
                                
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-tie display-4 d-block mb-3 text-opacity-25 text-secondary"></i>
                                    <p class="mb-1 fw-medium">No teachers found</p>
                                    <p class="small text-muted mb-3">Get started by registering your first teacher.</p>
                                    <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-primary">Add Teacher</a>
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
    body { background-color: #f8f9fa; }
    .table th { letter-spacing: 0.05em; font-size: 0.75rem; padding-top: 1rem; padding-bottom: 1rem; }
    .table td { padding-top: 1rem; padding-bottom: 1rem; }
</style>
@endsection