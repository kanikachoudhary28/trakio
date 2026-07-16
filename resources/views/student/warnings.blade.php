@extends('layouts.student')
@section('title', 'TRAKIO Warnings')
@section('content')
<div class="container-fluid mt-2">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold text-dark mb-1"><i class="fas fa-shield-halved text-danger me-2"></i> TRAKIO Alert Center</h4>
            <p class="text-muted small mb-0">Real-time indicators tracking any required attention flags for administrative or academic criteria.</p>
        </div>
    </div>

    @forelse($activeAlerts as $alert)
        <div class="card border-0 shadow-sm mb-3" style="border-left: 5px solid #e74c3c !important;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="fw-bold text-danger mb-0"><i class="fas fa-exclamation-circle me-2"></i> {{ $alert['type'] }}</h5>
                    <span class="badge bg-danger text-white">{{ $alert['severity'] }}</span>
                </div>
                <p class="text-dark mb-2 fw-medium">{{ $alert['message'] }}</p>
                <div class="p-3 bg-light rounded text-secondary small">
                    <strong><i class="far fa-lightbulb text-warning me-1"></i> Suggested Action:</strong> {{ $alert['solution'] }}
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm text-center p-5">
            <div class="card-body">
                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                <h4 class="fw-bold text-success">Excellent Condition!</h4>
                <p class="text-muted mb-0">You are fulfilling all requirements smoothly. No warnings issued by TRAKIO engine.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection