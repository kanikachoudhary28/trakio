@extends('layouts.teacher')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white p-3 d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 20px; font-weight: bold;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-id-card me-1"></i> Profile Settings</h5>
                        <small class="text-muted">Manage your personal details and account credentials</small>
                    </div>
                </div>

                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('teacher.profile.update') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- 1. Full Name (Editable) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <!-- 2. Email Address (🔒 Readonly - Locked for Teacher) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Email Address</label>
                                <input type="email" class="form-control bg-light text-muted" value="{{ $user->email }}" readonly>
                                <small class="text-muted" style="font-size: 11px;">* Contact Admin to change email.</small>
                            </div>

                            <!-- 3. Phone Number (Editable) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Phone / Contact</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}" required>
                            </div>

                            <!-- 4. Designation (🔒 Readonly - Locked for Teacher) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Designation</label>
                                <input type="text" class="form-control bg-light text-muted" value="{{ $teacher->designation }}" readonly>
                                <small class="text-muted" style="font-size: 11px;">* Officially assigned by management.</small>
                            </div>
                        </div>

                        <hr class="text-muted my-4">
                        <h6 class="fw-bold text-danger mb-3"><i class="fas fa-lock me-1"></i> Change Password (Optional)</h6>

                        <div class="row">
                            <!-- 5. New Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                            </div>

                            <!-- 6. Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="border-radius: 6px !important;">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection