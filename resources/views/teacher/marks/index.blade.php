@extends('layouts.teacher')

@section('title', 'Marks Entry')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white p-3">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-pen-alt me-2"></i> Examination Marks Entry</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('teacher.marks.manage') }}" method="GET">
                        <div class="mb-3">
                            <label for="batch_id" class="form-label fw-bold">Select Class / Batch</label>
                            <select name="batch_id" id="batch_id" class="form-select" required>
                                <option value="">-- Choose Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subject_id" class="form-label fw-bold">Select Subject</label>
                            <select name="subject_id" id="subject_id" class="form-select" required disabled>
                                <option value="">-- First Choose a Batch --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="assessment_type" class="form-label fw-bold">Assessment / Exam Type</label>
                            <select name="assessment_type" id="assessment_type" class="form-select" required>
                                <option value="">-- Choose Exam --</option>
                                <option value="Sessional 1">Sessional 1</option>
                                <option value="Sessional 2">Sessional 2</option>
                                <option value="Mid-Term">Mid-Term Exam</option>
                                <option value="Final Practical">Final Practical</option>
                                <option value="Assignment">Assignment</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="max_marks" class="form-label fw-bold">Maximum Marks (Total)</label>
                            <input type="number" name="max_marks" id="max_marks" class="form-control" placeholder="e.g. 50 or 100" min="1" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fas fa-arrow-right me-2"></i> Open Marks Sheet
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#batch_id').on('change', function() {
        var batchId = $::this::.val();
        var subjectDropdown = $('#subject_id');

        if(batchId) {
            // Loader status
            subjectDropdown.html('<option value="">Loading subjects...</option>').prop('disabled', false);
            
            // AJAX request to fetch subjects assigned to this batch
            $.ajax({
                url: '/get-subjects/' + batchId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    subjectDropdown.html('<option value="">-- Choose Subject --</option>');
                    $.each(data, function(key, value) {
                        // Maan kar chal rahe hain aapka Controller array ya id=>name format bhej rha hai
                        // Agar response check karna ho toh console.log(data) kar sakte hain
                        var id = value.id ? value.id : key;
                        var name = value.subject_name ? value.subject_name : value;
                        subjectDropdown.append('<option value="' + id + '">' + name + '</option>');
                    });
                },
                error: function() {
                    subjectDropdown.html('<option value="">Error loading subjects</option>');
                }
            });
        } else {
            subjectDropdown.html('<option value="">-- First Choose a Batch --</option>').prop('disabled', true);
        }
    });
});
</script>
@endsection