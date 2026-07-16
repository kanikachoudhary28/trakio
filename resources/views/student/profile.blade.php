@extends('layouts.student')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid mt-2">
    
   @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    @if(!empty($student->image) && file_exists(public_path($student->image)))
                        <img src="{{ asset($student->image) }}" class="rounded-circle img-thumbnail shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=150" class="rounded-circle img-thumbnail shadow-sm" style="width: 150px; height: 150px;">
                    @endif
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-0">Roll No: {{ $student->roll_number ?? 'N/A' }}</p>
                <p class="text-secondary small mb-0">
    <i class="fas fa-venus-mars me-1"></i> Gender: <span class="fw-bold">{{ $student->gender ?? 'Not Specified' }}</span>
</p>
                <span class="badge bg-light text-primary border mt-2 px-3 py-2">Student Account</span>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-user-edit text-primary me-2"></i> Update Personal Information</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">Full Name (Read Only)</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">Email Address (Read Only)</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">Contact Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}" placeholder="Enter phone number">
                            </div>
                            <div class="col-md-6">
    <label class="form-label text-secondary small fw-bold">Gender</label>
    <select name="gender" class="form-select">
        <option value="">Select Gender</option>
    
        <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ $student->gender == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-bold">Upload Profile Photo</label>
                                <input type="file" name="profile_image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-secondary small fw-bold">Residential Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Enter full address">{{ $student->address }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary fw-bold px-4 mt-4"><i class="fas fa-save me-1"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection