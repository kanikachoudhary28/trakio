@extends('layouts.teacher')

@section('title', 'Mark Attendance')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm mt-4">
        
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1 text-primary">
                    <i class="fas fa-users me-2"></i> Attendance Sheet
                </h5>
                <p class="text-muted small mb-0">
                    <strong>Class/Batch:</strong> {{ $selectedBatch->batch_name }} | 
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                </p>
            </div>
            <a href="{{ route('teacher.attendance.select') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Change Batch
            </a>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('teacher.attendance.store') }}" method="POST">
                @csrf
                <input type="hidden" name="batch_id" value="{{ $selectedBatch->id }}">
                <input type="hidden" name="date" value="{{ $date }}">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;" class="ps-4">S.No</th>
                                <th style="width: 180px;">Roll Number</th>
                                <th>Student Name</th>
                                <th class="text-center" style="width: 250px;">Mark Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                @php
                                    // 🔥 Purana status nikalna agar database mein hai, nahi toh default 'present'
                                    $currentStatus = $existingAttendance[$student->id] ?? 'present';
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
                                        <div class="btn-group" role="group" aria-label="Attendance Status">
                                            
                                            <input type="radio" 
                                                   class="btn-check" 
                                                   name="attendance[{{ $student->id }}]" 
                                                   id="present_{{ $student->id }}" 
                                                   value="present" 
                                                   {{ $currentStatus == 'present' ? 'checked' : '' }}> <label class="btn btn-outline-success btn-sm px-3" for="present_{{ $student->id }}">
                                                <i class="fas fa-check me-1"></i> Present
                                            </label>

                                            <input type="radio" 
                                                   class="btn-check" 
                                                   name="attendance[{{ $student->id }}]" 
                                                   id="absent_{{ $student->id }}" 
                                                   value="absent"
                                                   {{ $currentStatus == 'absent' ? 'checked' : '' }}> <label class="btn btn-outline-danger btn-sm px-3" for="absent_{{ $student->id }}">
                                                <i class="fas fa-times me-1"></i> Absent
                                            </label>

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
                            <i class="fas fa-cloud-upload-alt me-2"></i> Submit Attendance
                        </button>
                    </div>
                @endif
            </form>
        </div>

    </div>
</div>
@endsection