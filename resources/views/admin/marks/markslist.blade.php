@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-graduation-cap me-2 text-success"></i> Student Marks Management
            </h5>
            <a href="{{ route('marks.create') }}" class="btn btn-sm btn-success px-3 rounded-pill">
                <i class="fas fa-plus me-1"></i> Add New Marks
            </a>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="adminMarksTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-secondary text-uppercase">
                        <tr>
                            <th class="ps-4">Subject</th>
                            <th>Assessment Type</th>
                            <th class="text-center">Max Marks</th>
                            <th class="text-center">Students Count</th>
                            <th>Entered By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($marksGroups as $group)
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">
                                    {{ $group->subject->subject_name ?? 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded">
                                        {{ strtoupper($group->assessment_type) }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold text-muted">
                                    {{ $group->max_marks }}
                                </td>
                                <td class="text-center fw-bold text-success">
                                    {{ $group->total_students }} Students
                                </td>
                                <td class="text-muted fw-medium">
                                    {{ optional($group->teacher)->name ?? 'Admin' }}
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-success px-3 rounded-pill view-marks-btn" 
                                            data-subject="{{ $group->subject_id }}"
                                            data-type="{{ $group->assessment_type }}"
                                            data-title="{{ $group->subject->subject_name }} - {{ strtoupper($group->assessment_type) }}">
                                        <i class="fas fa-eye me-1"></i> View Marks
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No marks records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewMarksModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header bg-light py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark" id="modal_marks_title">Marks Sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small fw-bold text-secondary">
                        <tr>
                            <th class="ps-4">Student Name</th>
                            <th class="text-center">Marks Obtained</th>
                            <th class="text-center">Percentage</th>
                        </tr>
                    </thead>
                    <tbody id="modal_marks_tbody">
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@vite(['resources/js/app.js'])
@endsection