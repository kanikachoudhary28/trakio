@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3" style="max-width: 600px; margin: 0 auto;">
        
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-edit me-2 text-success"></i> Edit Subject Assignment</h5>
            <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-light border">Back</a>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')

              <!-- 1. Select Teacher Dropdown Fix -->
<div class="mb-3">
    <label class="form-label fw-semibold text-secondary">Select Teacher</label>
    <select name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}" {{ $assignment->teacher_id == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->user->name ?? 'N/A' }} 
            </option>
        @endforeach
    </select>
    @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

                <!-- 2. Select Batch -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Select Batch / Semester</label>
                    <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ $assignment->batch_id == $batch->id ? 'selected' : '' }}>
                                {{ $batch->batch_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- 3. Select Subject -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary">Select Subject</label>
                    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_code }} - {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('assignments.index') }}" class="btn btn-light px-4">Cancel</a>
                    <button type="submit" class="btn btn-success px-4">Update Assignment</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection