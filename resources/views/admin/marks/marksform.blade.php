@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-plus-circle me-2 text-success"></i> Enter Student Marks
                    </h5>
                    <a href="{{ route('marks.index') }}" class="btn btn-sm btn-light border px-3 rounded-pill">Back</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('marks.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-secondary">Select Batch</label>
                                <select name="batch_id" id="marks_batch_id" class="form-select" required>
                                    <option value="" selected disabled>Choose batch...</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-secondary">Select Subject</label>
                                <select name="subject_id" id="marks_subject_id" class="form-select" required>
                                    <option value="" selected disabled>Choose subject...</option>
                                    @foreach($subjects as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-secondary">Assessment Type</label>
                                <select name="assessment_type" class="form-select" required>
                                    <option value="class_test">Class Test</option>
                                    <option value="mid_term">Mid Term</option>
                                    <option value="final_exam">Final Exam</option>
                                    <option value="assignment">Assignment</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-secondary">Max Marks</label>
                                <input type="number" name="max_marks" id="max_marks_input" class="form-control" placeholder="e.g. 100" min="1" required>
                            </div>
                        </div>

                        <div id="marks_sheet_container" class="d-none">
                            <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Enter Marks below:</h6>
                            <div class="table-responsive rounded-3 border mb-3">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light small fw-bold text-secondary text-uppercase">
                                        <tr>
                                            <th class="ps-4">Student Name</th>
                                            <th class="text-center" style="width: 200px;">Obtained Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marks_sheet_tbody">
                                        </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success px-5 py-2 fw-medium shadow-sm float-end">Save Marks</button>
                        </div>

                        <div id="marks_no_students_alert" class="alert alert-warning border-0 d-none">
                            <i class="fas fa-exclamation-triangle me-2"></i> No students found in this batch.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@vite(['resources/js/app.js'])
@endsection