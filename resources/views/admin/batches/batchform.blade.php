@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i> Create New Batch
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form action="{{ route('batches.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Batch Name</label>
                            <input type="text" name="batch_name" class="form-control" placeholder="e.g., BCA 1st Sem" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Academic Year</label>
                            <input type="text" name="academic_year" class="form-control" placeholder="e.g., 2026-2027" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-medium shadow-sm">
                            <i class="fas fa-plus me-1"></i> Save Batch
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection