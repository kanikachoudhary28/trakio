@extends('layouts.teacher')
@section('title', 'Performance Report')
@section('content')
<div class="container-fluid mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-chart-pie me-2"></i> Academic Performance: {{ $selectedBatch->batch_name }}</h5>
            </div>
            <a href="{{ route('teacher.performance.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Roll Number</th>
                            <th>Student Name</th>
                            <th class="text-center">Attendance Status</th>
                            <th class="text-center">Academic Score Average</th>
                            <th class="text-center">Overall Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">{{ $student->roll_number ?? 'N/A' }}</td>
                                <td class="fw-bold text-dark">{{ $student->user->name }}</td>
                                
                                <!-- Attendance Badge -->
                                <td class="text-center">
                                    <span class="badge {{ $student->attendance_percentage < 75 ? 'bg-danger' : 'bg-success' }} p-2 fs-6">
                                        {{ $student->attendance_percentage }}%
                                    </span>
                                </td>

                                <!-- Marks Badge -->
                                <td class="text-center">
                                    @if($student->marks_percentage !== null)
                                        <span class="badge {{ $student->marks_percentage < 40 ? 'bg-danger' : ($student->marks_percentage >= 75 ? 'bg-success' : 'bg-warning text-dark') }} p-2 fs-6">
                                            {{ $student->marks_percentage }}%
                                        </span>
                                    @else
                                        <span class="text-muted small">No Exams Yet</span>
                                    @endif
                                </td>

                                <!-- Dynamic Rating -->
                                <td class="text-center">
                                    @if($student->attendance_percentage >= 75 && ($student->marks_percentage >= 75 || $student->marks_percentage === null))
                                        <span class="badge bg-light text-success border border-success fw-bold px-3 py-2"><i class="fas fa-star me-1"></i> Excellent</span>
                                    @elseif($student->attendance_percentage < 75 || $student->marks_percentage < 40)
                                        <span class="badge bg-light text-danger border border-danger fw-bold px-3 py-2"><i class="fas fa-exclamation-triangle me-1"></i> At Risk</span>
                                    @else
                                        <span class="badge bg-light text-warning border border-warning fw-bold px-3 py-2"><i class="fas fa-thumbs-up me-1"></i> Average</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection