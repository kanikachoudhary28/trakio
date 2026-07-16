@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ route('subjects.index') }}" class="text-decoration-none">Subjects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Subject</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-book text-success me-2"></i> Create New Subject
                    </h5>
                    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('subjects.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="subject_name" class="form-label text-secondary small fw-medium">Subject Name</label>
                                <input type="text" name="subject_name" id="subject_name" class="form-control @error('subject_name') is-invalid @enderror" value="{{ old('subject_name') }}" placeholder="e.g. Data Structures" required>
                                @error('subject_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="subject_code" class="form-label text-secondary small fw-medium">Subject Code</label>
                                <input type="text" name="subject_code" id="subject_code" class="form-control @error('subject_code') is-invalid @enderror" value="{{ old('subject_code') }}" placeholder="e.g. BCA-102" required>
                                @error('subject_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="batch_id" class="form-label text-secondary small fw-medium">Select Batch</label>
                                <select name="batch_id" id="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Choose a batch...</option>
                                    @foreach($batches as $b)
                                        <option value="{{ $b->id }}" {{ old('batch_id') == $b->id ? 'selected' : '' }}>
                                            {{ $b->batch_name }} {{-- column ka sahi naam --}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="pt-4 d-flex gap-2 justify-content-end">
                            <a href="{{ route('subjects.index') }}" class="btn btn-light px-4 border">Cancel</a>
                            <button type="submit" class="btn btn-success text-white px-4 shadow-sm fw-medium">
                                <i class="fas fa-save me-1"></i> Save Subject
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
    .form-control, .form-select { padding: 0.6rem 0.8rem; border-radius: 8px; }
</style>
@endsection