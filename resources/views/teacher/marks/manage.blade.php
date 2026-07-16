@extends('layouts.teacher')

@section('title', 'Enter Marks')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm mt-4">
        
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1 text-primary">
                    <i class="fas fa-pen-alt me-2"></i> Marks Entry Sheet
                </h5>
                <p class="text-muted small mb-0">
                    <strong>Class/Batch:</strong> {{ $selectedBatch->batch_name }} | 
                    <strong>Subject:</strong> {{ $selectedSubject->subject_name ?? $selectedSubject->name }}
                    <strong>Exam:</strong> {{ $assessmentType }} | 
                    <strong>Max Marks:</strong> <span class="badge bg-primary">{{ $maxMarks }}</span>
                </p>
            </div>
            <a href="{{ route('teacher.marks.select') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Change Selection
            </a>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('teacher.marks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">
                <input type="hidden" name="batch_id" value="{{ $selectedBatch->id }}">
                <input type="hidden" name="assessment_type" value="{{ $assessmentType }}">
                <input type="hidden" name="max_marks" value="{{ $maxMarks }}">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;" class="ps-4">S.No</th>
                                <th style="width: 180px;">Roll Number</th>
                                <th>Student Name</th>
                                <th class="text-center" style="width: 200px;">Marks Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                @php
                                    // 🔥 Pehle se entered marks nikalna agar database mein hain
                                    $score = $existingMarks[$student->id] ?? '';
                                @endphp
                                <tr>
                                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                    
                                    <td>
                                        <span class="badge bg-secondary p-2 fs-6 fw-bold">
                                            {{ $student->roll_number ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td>
                                        <h6 class="fw-bold mb-0 text-dark">
                                            {{ $student->user->name ?? 'No Name Found' }}
                                        </h6>
                                        <small class="text-muted">User ID: {{ $student->user_id }}</small>
                                    </td>

                                    <td class="text-center">
                                        <div class="input-group justify-content-center">
                                            <input type="number" 
                                                   name="marks[{{ $student->id }}]" 
                                                   class="form-control text-center fw-bold text-primary" 
                                                   style="max-width: 120px; border-radius: 6px;"
                                                   placeholder="Enter"
                                                   min="0" 
                                                   max="{{ $maxMarks }}" 
                                                   value="{{ $score }}" 
                                                   required>
                                            <span class="input-group-text bg-light fw-bold text-muted">/ {{ $maxMarks }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-3 d-block text-warning"></i>
                                        No students found in this batch.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($students->count() > 0)
                    <div class="card-footer bg-white p-3 text-end border-top">
                        <button type="submit" class="btn btn-success fw-bold px-4">
                            <i class="fas fa-save me-2"></i> Save & Update Marks
                        </button>
                    </div>
                @endif
            </form>
        </div>

    </div>
</div>
@endsection