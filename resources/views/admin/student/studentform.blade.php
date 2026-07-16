@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-user-plus text-primary me-2"></i> Register New Student
                    </h5>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('students.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Account Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-secondary small fw-medium">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-content form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter full name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label text-secondary small fw-medium">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="student@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="password" class="form-label text-secondary small fw-medium">Password (Min. 6 characters)</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                    <div class="form-text text-muted small">This password will be used by the student to login.</div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted my-4 opacity-25">

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Academic Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="roll_number" class="form-label text-secondary small fw-medium">Roll Number / Unique ID</label>
                                    <input type="text" name="roll_number" id="roll_number" class="form-control @error('roll_number') is-invalid @enderror" value="{{ old('roll_number') }}" placeholder="e.g. STU12345" required>
                                    @error('roll_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
    <label for="batch_id" class="form-label text-secondary small fw-medium">Assign Batch</label>
    <select name="batch_id" id="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
        <option value="" selected disabled>Choose a batch...</option>
        @foreach($batches as $b)
            <option value="{{ $b->id }}" {{ old('batch_id') == $b->id ? 'selected' : '' }}>
                {{ $b->batch_name }}
            </option>
        @endforeach
    </select>
    @error('batch_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                            </div>
                        </div>

                        <div class="pt-2 d-flex gap-2 justify-content-end">
                            <a href="{{ route('students.index') }}" class="btn btn-light px-4 border">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm fw-medium">
                                <i class="fas fa-save me-1"></i> Save Student
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa; /* Light clean grey background */
    }
    .card {
        border-radius: 12px !important;
    }
    .form-control, .form-select {
        padding: 0.6rem 0.8rem;
        border-color: #dee2e6;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    .tracking-wider {
        letter-spacing: 0.05em;
    }
</style>
@endsection