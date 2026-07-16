@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-bullhorn me-2 text-danger"></i> Issue Warning Notice
                    </h5>
                    <a href="{{ route('warnings.index') }}" class="btn btn-sm btn-light border px-3 rounded-pill">Back</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('warnings.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Select Batch</label>
                                <select id="warning_batch_id" class="form-select" required>
                                    <option value="" selected disabled>Choose batch...</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Select Student</label>
                                <select name="student_id" id="warning_student_dropdown" class="form-select" required disabled>
                                    <option value="" selected disabled>Choose student...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Warning Category</label>
                                <select name="warning_type" class="form-select" required>
                                    <option value="low_attendance">Low Attendance</option>
                                    <option value="poor_academic_performance">Poor Academic Performance</option>
                                    <option value="disciplinary_issue">Disciplinary Issue</option>
                                    <option value="late_submission">Late Assignment Submission</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Severity Level</label>
                                <select name="severity_level" class="form-select" required>
                                    <option value="low">Low (First Reminder)</option>
                                    <option value="medium">Medium (Official Warning)</option>
                                    <option value="critical">Critical (Final Notice)</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Issue Date</label>
                                <input type="date" name="issue_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Detailed Reason / Remarks</label>
                            <textarea name="reason" class="form-control" rows="4" placeholder="Explain the detailed reason behind issuing this warning letter..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger px-5 py-2 fw-medium shadow-sm float-end">Issue Warning</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- External CDNs for UI Fluid Triggers -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/resources/js/script.js"></script>
@endsection