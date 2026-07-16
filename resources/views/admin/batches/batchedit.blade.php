@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3" style="max-width: 600px; margin: 0 auto;">
        
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-edit me-2 text-primary"></i> Edit Batch Details</h5>
            <a href="{{ route('batches.index') }}" class="btn btn-sm btn-light text-secondary border">Back to List</a>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Batch Name</label>
                    <input type="text" name="batch_name" class="form-control @error('batch_name') is-invalid @enderror" value="{{ old('batch_name', $batch->batch_name) }}" required>
                    @error('batch_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary">Academic Year</label>
                    <input type="text" name="academic_year" class="form-control @error('academic_year') is-invalid @enderror" value="{{ old('academic_year', $batch->academic_year) }}" required>
                    @error('academic_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('batches.index') }}" class="btn btn-light px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Update Batch</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection