@extends('layouts.student')
@section('title', 'My Performance Insights')
@section('content')
<div class="container-fluid mt-2">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold text-dark mb-1"><i class="fas fa-chart-bar text-primary me-2"></i> Academic Analytics Summary</h4>
            <p class="text-muted small mb-0">Understand your scoring trends and attendance levels dynamically mapped by TRAKIO.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold text-secondary mb-0">Subject-wise Analytics Record</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Subject Name</th>
                            <th>Assessment Type</th>
                            <th>Marks Split</th>
                            <th>Performance Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjectPerformance as $row)
                            @php $pct = ($row->marks_obtained / $row->max_marks) * 100; @endphp
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $row->subject_name }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row->assessment_type }}</span></td>
                                <td class="fw-bold text-primary">{{ $row->marks_obtained }} / {{ $row->max_marks }}</td>
                                <td>
                                    @if($pct >= 75) <span class="badge bg-success">Top Tier</span>
                                    @elseif($pct < 40) <span class="badge bg-danger">Critical Care</span>
                                    @else <span class="badge bg-warning text-dark">Stable Progress</span> @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">No breakdown data available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection