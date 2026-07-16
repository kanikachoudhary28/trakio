@extends('layouts.teacher')
@section('title', 'Student Performance')
@section('content')
<div class="container-fluid mt-4">
    <h4 class="fw-bold mb-3 text-dark"><i class="fas fa-chart-line text-primary me-2"></i> Student Performance Analytics</h4>
    <div class="row">
        @foreach($batches as $batch)
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="text-primary mb-2"><i class="fas fa-graduation-cap fa-2x"></i></div>
                        <h5 class="fw-bold text-dark">{{ $batch->batch_name }}</h5>
                        <p class="text-muted small">Analyze academic scores & track attendance insights dynamically.</p>
                        <a href="{{ route('teacher.performance.batch', $batch->id) }}" class="btn btn-primary btn-sm w-100 fw-bold">
                            <i class="fas fa-chart-bar me-1"></i> View Analytics Report
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection