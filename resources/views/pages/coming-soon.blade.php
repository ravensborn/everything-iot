@extends('layouts.master')


@section('content')



    <!-- Content -->
    <div class="d-md-flex">
        <div class="container d-md-flex align-items-md-center vh-md-100 content-space-t-3 content-space-b-1 content-space-b-md-3 content-space-md-0">
            <div class="row justify-content-md-between align-items-md-center flex-grow-1">
                <div class="col-9 col-md-5 mb-5 mb-md-0">
                    <img class="img-fluid" src="{{ asset('themes/front/assets/svg/illustrations/oc-yelling.svg') }}" alt="SVG Illustration">
                </div>
                <!-- End Col -->

                <div class="col-md-6">
                    <!-- Heading -->
                    <div class="mb-4">
                        <h1>This page / functionality is coming soon.</h1>
                        <p>Our website is under construction. We'll be here soon with our new awesome site, subscribe to be notified.</p>
                        <a href="{{ route('home') }}">Return to home.</a>
                    </div>
                    <!-- End Heading -->

                    <!-- End Row -->

                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
    <!-- End Content -->

@endsection
