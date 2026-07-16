@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}" class="text-decoration-none">Teachers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Teacher</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-user-edit text-warning me-2"></i> Edit Teacher Details
                    </h5>
                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Account Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-medium">Full Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teacher->user->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-medium">Email Address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $teacher->user->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label text-secondary small fw-medium">Password (Leave blank if you don't want to change)</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted my-4 opacity-25">

                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold small tracking-wider mb-3">Professional Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-medium">Phone Number</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $teacher->phone) }}">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-secondary small fw-medium">Designation</label>
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $teacher->designation) }}">
                                    @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 d-flex gap-2 justify-content-end">
                            <a href="{{ route('teachers.index') }}" class="btn btn-light px-4 border">Cancel</a>
                            <button type="submit" class="btn btn-warning text-white px-4 shadow-sm fw-medium">
                                <i class="fas fa-sync-alt me-1"></i> Update Teacher
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
    .form-control { padding: 0.6rem 0.8rem; border-radius: 8px; }
</style>
@endsection