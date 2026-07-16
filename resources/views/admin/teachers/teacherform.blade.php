@extends('layouts.admin') {{-- Apne layout ka naam check kar lena --}}

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}" class="text-decoration-none">Teachers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Teacher</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-user-tie text-primary me-2"></i> Register New Teacher
                    </h5>
                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
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

                    <form action="{{ route('teachers.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Account Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-secondary small fw-medium">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter professor name" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label text-secondary small fw-medium">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="teacher@example.com" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="password" class="form-label text-secondary small fw-medium">Password (Min. 6 characters)</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted my-4 opacity-25">

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Professional Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label text-secondary small fw-medium">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Enter phone number">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="designation" class="form-label text-secondary small fw-medium">Designation</label>
                                    <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') }}" placeholder="e.g. Assistant Professor, HOD">
                                    @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 d-flex gap-2 justify-content-end">
                            <a href="{{ route('teachers.index') }}" class="btn btn-light px-4 border">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm fw-medium">
                                <i class="fas fa-save me-1"></i> Save Teacher
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 12px !important; }
    .form-control { padding: 0.6rem 0.8rem; border-radius: 8px; }
    .tracking-wider { letter-spacing: 0.05em; }
</style>
@endsection