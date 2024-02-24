@extends('layouts.store')


@section('content')

    <!-- Breadcrumb -->
    <div class="bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-sm">
                    <h4 class="mb-0">{{ __('website.about.about_timenet') }}</h4>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">{{ __('website.breadcrumb.timenet') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('website.breadcrumb.about_us') }}
                            </li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Gallery -->
    <div class="container content-space-t-1 content-space-lg-1">
        <div class="w-lg-75 text-center mx-lg-auto">
            <!-- Heading -->
            <div class="mb-5 mb-md-10">
                <div class="row">
                    <div class="col text-center">
                        <img style="width: 50%; height: auto;" src="{{ asset('images/logo-dark.png') }}" alt="Wallpaper">
                    </div>
                </div>
                <p class="lead mt-5">
                    {{ __('website.about.paragraph_1') }}
                </p>
            </div>
            <!-- End Heading -->
        </div>




        <!-- End Row -->
    </div>
    <!-- End Gallery -->

    <div class="border-top mx-auto" style="max-width: 30rem;"></div>


    <div class="border-top mx-auto" style="max-width: 30rem;"></div>


@endsection
