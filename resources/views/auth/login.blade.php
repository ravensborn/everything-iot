@extends('layouts.master')

@section('content')
    <div class="container content-space-2">
        <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
                <h1 class="h2">Welcome back</h1>
                <p>Login to {{ config('env.APP_NAME')  }} to manage your account.</p>
            </div>
            <!-- End Heading -->

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="email">E-Mail Address</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                           value="{{ old('email') }}"
                           placeholder="email@example.com" aria-label="email@example.com" required="">
                    @error('email')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label" for="password">Password</label>

                        <a class="form-label-link text-dark" href="{{ route('password.request') }}" tabindex="-1">Forgot Password?</a>
                    </div>

                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control form-control-lg" name="password" id="password"
                               placeholder="8+ characters required" aria-label="8+ characters required">
                    </div>
                    @error('password')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Check -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember"
                           name="remember" checked>
                    <label class="form-check-label small" for="remember">Remember Me</label>
                </div>
                <!-- End Check -->

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-dark btn-lg">Log in</button>
                </div>

                <div class="text-center">
                    <p>Don't have an account yet? <a class="link text-dark" href="{{ route('register') }}">Sign up here</a></p>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
@endsection
