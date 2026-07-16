@extends('layouts.auth') @section('content')
<div class="container py-5">
    <div class="row justify-content-center">
       <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
            <div class="card p-4 shadow-sm" style="width: 100%; max-width: 500px;">
                <h4 class="fw-bold mb-2 text-dark">Forgot Password?</h4>
                <p class="text-muted small mb-4">No problem. Just let us know your email address and we will email you a password reset link.</p>

                @if (session('status'))
                    <div class="alert alert-success small border-0 mb-3">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="enter your registered email">
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-medium">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection