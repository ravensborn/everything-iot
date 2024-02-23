@extends('layouts.master')


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
                <h1 class="display-4">{{ __('website.about.about_us') }}</h1>
                <p class="lead mt-5">
                    {{ __('website.about.paragraph_1') }}
                </p>
            </div>
            <!-- End Heading -->
        </div>

        <div class="row gx-3">
            <div class="col mb-3">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/1.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->

            <div class="col-3 d-none d-md-block mb-3">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/5.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->

            <div class="col mb-3">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/3.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->

            <div class="w-100"></div>

            <div class="col mb-3 mb-md-0">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/4.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->

            <div class="col-4 d-none d-md-block mb-3 mb-md-0">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/2.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->

            <div class="col">
                <div class="bg-img-start"
                     style="background-image: url({{ asset('images/wallpapers/about/6.jpg') }}); height: 15rem;"></div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Gallery -->

    <div class="border-top mx-auto" style="max-width: 30rem;"></div>

    <!-- Info -->
    <div class="container content-space-1 content-space-lg-1">
        <div class="row text-center">

            <div class="col-lg-12">

                <h2 class="mb-4">{{ __('website.about.paragraph_2') }}</h2>

                {!! __('website.about.paragraph_3') !!}
            </div>
            <!-- End Col -->
        </div>
        <div class="row mt-5 justify-content-lg-center">
            <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                <div class="text-center">
                    <h2 class="display-4">17</h2>
                    <p class="fw-bold fs-4">{{ __('website.about.years_in') }}</p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-sm-4 col-lg-3 mb-7 mb-sm-0">
                <div class="text-center">
                    <h2 class="display-4">1,200</h2>
                    <p class="fw-bold fs-4">{{ __('website.about.clients') }}</p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-sm-4 col-lg-3">
                <div class="text-center">
                    <h2 class="display-4">100%</h2>
                    <p class="fw-bold fs-4">{{ __('website.about.happy_customers') }}</p>
                </div>
            </div>
            <!-- End Col -->
        </div>
    </div>
    <!-- End Info -->

    <div class="border-top mx-auto" style="max-width: 30rem;"></div>

    <!-- Team -->
    <div class="container content-space-1 content-space-lg-1">
        <!-- Heading -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">

            <h2>{{ __('website.about.time_net_team_headline') }}</h2>
            <p>
                ({{ __('website.about.time_net_team_description') }}
            </p>
        </div>
        <!-- End Heading -->

        <div class="row gx-3 mb-5 d-flex justify-content-center text-center">

            @foreach($teamMembers as $member)
                <div class="col-sm-6 col-lg-3 mb-3">
                    <!-- Card -->
                    <div class="card card-transition h-100">
                        <div class="card-body">
                            <div class="avatar avatar-lg avatar-circle mb-4">
                                <img class="avatar-img" src="{{ $member->getFirstMediaUrl('image') }}"
                                     alt="Image">
                            </div>

                            <span class="card-subtitle">{{ $member->position }}</span>
                            <h4 class="card-title">{{ ucwords($member->name)  }}</h4>
                            <p class="card-text">
                                {{ $member->description }}
                            </p>
                        </div>

                        <div class="card-footer pt-0">
                            <!-- Socials -->
                            <ul class="list-inline mb-0">
                                @foreach($member->links as $link)
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-xs btn-icon rounded" href="{{ $link['url'] }}">
                                            <i class="{{ $link['icon'] }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- End Socials -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            @endforeach
        </div>
        <!-- End Row -->


    </div>
    <!-- End Team -->

@endsection
