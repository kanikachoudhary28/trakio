@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-file-csv text-primary me-2"></i> Bulk Student Import (CSV)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ url('/admin/students/import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Assign To Batch</label>
                            <select name="batch_id" class="form-select" required>
                                <option value="" selected disabled>Choose target batch...</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Upload CSV File</label>
                            <input type="file" name="excel_file" class="form-control" accept=".csv" required>
                            <div class="form-text text-muted small mt-2">
                                <i class="fas fa-info-circle me-1"></i> 
                                <strong>How to prepare file:</strong> Create data in Excel with columns <code>name</code>, <code>email</code>, <code>phone</code>, then click <strong>Save As -> CSV (.csv)</strong> format.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill shadow-sm fw-medium d-flex align-items-center justify-content-center">
                            <i class="fas fa-cloud-upload-alt me-2"></i> Start Import & Dispatch Emails
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection