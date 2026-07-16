@extends('layouts.teacher')

@section('title', 'Manage Attendance')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white p-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-calendar-check me-2"></i> Take Attendance</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('teacher.attendance.manage') }}" method="GET">
                        <div class="mb-3">
                            <label for="batch_id" class="form-label fw-bold">Select Class / Batch</label>
                            <select name="batch_id" id="batch_id" class="form-select" required>
                                <option value="">-- Choose Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-bold">Attendance Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-day') }}" max="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fas fa-arrow-right me-2"></i> Proceed to Students List
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection