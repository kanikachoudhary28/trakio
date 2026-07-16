@extends('layouts.auth')

@section('title', 'Login - Trakio')

@section('content')

<section class="login-section">

    <div class="container">

        <div class="row login-card shadow-lg">

            <!-- Left Side -->

            <div class="col-lg-6 login-left">

                <div>

                    <h1>TRAKIO</h1>

                    <p>
                        Smart Student Performance &
                        Early Warning System
                    </p>

                    <img
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1000"
                        class="img-fluid rounded-4 mt-4"
                        alt="Students">

                </div>

            </div>

            <!-- Right Side -->

            <div class="col-lg-6 login-right">

                <div class="login-form-wrapper">

                    <h2>Welcome Back</h2>

                    <p class="text-muted mb-4">
                        Login to continue to Trakio
                    </p>
@if ($errors->has('email'))
<div class="alert alert-danger">
    {{$errors->first('email')}}
</div>
    
@endif
                    <form method="POST" action="{{ route('login.submit')}}">
             @csrf
                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{old('email')}}"
                                class="form-control @error('email') is-invalid
                                    
                                @enderror"
                                placeholder="Enter your email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter your password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                    
                                @enderror

                        </div>

     <div class="mb-3 form-check d-flex justify-content-between align-items-center">
    <div>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
<label for="remember">Remember Me</label>
    </div>
    
   <a class="small text-primary text-decoration-none" href="{{ route('password.request') }}">
    Forgot Password?
</a>
</div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection