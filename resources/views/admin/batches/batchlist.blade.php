@extends('layouts.admin')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-list me-2 text-primary"></i> All Batches</h5>
            <a href="{{ route('batches.create') }}" class="btn btn-sm btn-primary px-3 rounded-pill">Add New Batch</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small fw-bold text-secondary text-uppercase">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Batch Name</th>
                        <th>Academic Year</th>
                        <th>Created At</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($batches as $batch)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">{{ $batch->id }}</td>
                            <td class="fw-semibold text-dark">{{ $batch->batch_name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $batch->academic_year }}</span></td>
                            <td class="text-muted small">{{ $batch->created_at ? $batch->created_at->format('d M, Y') : 'N/A' }}</td>
                            
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-sm btn-light text-primary border-0 shadow-sm" title="Edit Batch" style="padding: 5px 10px; border-radius: 6px;">
                                        <i class="fas fa-edit"></i> <span class="small">Edit</span>
                                    </a>

                                    <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Kya aap sach mein is batch ko delete karna chahte hain?');" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border-0 shadow-sm" title="Delete Batch" style="padding: 5px 10px; border-radius: 6px;">
                                            <i class="fas fa-trash-alt"></i> <span class="small">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No batches created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection