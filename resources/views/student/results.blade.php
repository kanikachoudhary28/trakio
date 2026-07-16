@extends('layouts.student')

@section('title', 'My Academic Results')

@section('content')
<div class="container-fluid mt-2">
    
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Total Exams Attempted</small>
                        <h4 class="fw-bold text-dark mb-0">{{ $totalExams }}</h4>
                    </div>
                    <div class="bg-light text-primary rounded p-2"><i class="fas fa-file-invoice-dollar fa-lg"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block">Clear / Passed Exams</small>
                        <h4 class="fw-bold text-success mb-0">{{ $passedExams }} / {{ $totalExams }}</h4>
                    </div>
                    <div class="bg-light text-success rounded p-2"><i class="fas fa-graduation-cap fa-lg"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-poll-h text-primary me-2"></i> Academic Report Card
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">S.No</th>
                            <th>Subject Name</th>
                            <th>Exam / Assessment Type</th>
                            <th>Marks Obtained</th>
                            <th>Percentage</th>
                            <th class="text-center" style="width: 150px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $index => $row)
                            @php
                                $percentage = $row->max_marks > 0 ? round(($row->marks_obtained / $row->max_marks) * 100, 1) : 0;
                            @endphp
                            <tr>
                                <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $row->subject_name }}</td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1">
                                        {{ $row->assessment_type }}
                                    </span>
                                </td>
                                <td class="fw-bold text-primary">
                                    {{ $row->marks_obtained }} <span class="text-muted small">/ {{ $row->max_marks }}</span>
                                </td>
                                <td class="fw-bold text-secondary">{{ $percentage }}%</td>
                                <td class="text-center">
                                    @if($percentage >= 75)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Excellent</span>
                                    @elseif($percentage < 40)
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Fail</span>
                                    @else
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">Good</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-2 text-warning d-block"></i>
                                    No sessional or exam results published for you yet.
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