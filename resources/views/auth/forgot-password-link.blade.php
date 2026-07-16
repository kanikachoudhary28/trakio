@extends('layouts.auth') @section('content')
<div class="container py-5" style="min-height: 100vh; display: flex; align-items: center;">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded-4 p-4">
                <h3 class="fw-bold text-dark mb-1">Reset Password</h3>
                <p class="text-muted small mb-4">Enter your email and choose a strong new password.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter your email">
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="At least 6 characters">
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat new password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-medium">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection  