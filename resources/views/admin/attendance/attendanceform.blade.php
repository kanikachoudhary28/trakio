@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-calendar-plus me-2 text-primary"></i> Fill Daily Attendance
                    </h5>
                    <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-light border px-3 rounded-pill">Back to List</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <!-- Batch Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Select Batch</label>
                                <select name="batch_id" id="batch_id" class="form-select" required>
                                    <option value="" selected disabled>Choose a batch...</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subject Dropdown -->
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Select Subject</label>
                                <select name="subject_id" id="subject_id" class="form-select" required>
                                    <option value="" selected disabled>Choose a subject...</option>
                                    <!-- Dynamic items will come here or you can load all subjects -->
                                    @foreach($subjects ?? [] as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Picker -->
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-secondary">Attendance Date</label>
                                <input type="date" name="date" id="attendance_date" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <!-- Dynamic Student Sheet Container  -->
                        <div id="student_sheet_container" class="d-none">
                            <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Student Attendance Sheet</h6>
                            <div class="table-responsive rounded-3 border mb-3">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light small fw-bold text-secondary text-uppercase">
                                        <tr>
                                            <th class="ps-4">Student Name</th>
                                            <th class="text-center">Status (Present / Absent)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="student_sheet_tbody">
                                        <!-- jQuery dynamically inputs students here -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-medium shadow-sm float-end">Save Sheet</button>
                        </div>

                        <div id="no_students_alert" class="alert alert-warning border-0 d-none" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> No students found in this batch.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection