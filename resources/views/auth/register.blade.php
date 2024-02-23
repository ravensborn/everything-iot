@extends('layouts.master')

@section('content')
    <div class="container content-space-2">
        <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
                <h1 class="h2">Become a {{ config('env.APP_NAME') }} member</h1>
                <p>Fill out the form to get started.</p>
            </div>
            <!-- End Heading -->

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">

            @csrf
            <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control form-control-lg" name="name" id="name"
                           value="{{ old('name') }}"
                           placeholder="Full Name" aria-label="Full Name" required="">
                    @error('name')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="email">Your email</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                           value="{{ old('email') }}"
                           placeholder="email@example.com" aria-label="email@example.com" required="">
                    @error('email')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="phone">Your phone number</label>
                    <input type="tel" class="form-control form-control-lg" name="phone_number" id="phone"
                           value="{{ old('phone_number') }}"
                           placeholder="+9647507534867" aria-label="+9647507534867" required="">
                    @error('phone_number')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="country_id">Country</label>
                    <select name="country_id" id="country_id" class="form-control form-control-lg" >
                        @foreach(\App\Models\EnabledCountry::all() as $country)
                            <option value="{{ $country->lc_country_id }}" selected>{{ $country->country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                           placeholder="8+ characters" aria-label="8+ characters" required="">
                    @error('password')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control form-control-lg" name="password_confirmation"
                           id="password_confirmation"
                           placeholder="8+ characters" aria-label="8+ characters" required="">
                    @error('password_confirmation')
                    <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <!-- End Form -->

                <!-- Check -->
                <p>
                    By submitting this form you have read and acknowledged the <a class="text-dark"
                                                                                  href="{{ route('privacy-and-policy') }}">Privacy
                        Policy</a>
                </p>
                <!-- End Check -->


                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-dark btn-lg">Sign up</button>
                </div>

                <div class="text-center">
                    <p>Already have an account? <a class="link text-dark" href="{{ route('login') }}">Log in here</a>
                    </p>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
@endsection
