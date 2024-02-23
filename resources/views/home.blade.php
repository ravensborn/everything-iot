@extends('layouts.master')


@section('content')

    <div class="content-space-b-1 homepage-main-banner" style="background-image: {{ $banner['backgroundOverlay'] }} url('{{ $banner['image'] }}'); background-position: {{ $banner['backgroundPosition'] }};">

        <div
            class="container d-md-flex align-items-md-center vh-md-70 content-space-t-4 content-space-b-3 content-space-md-0">
            <div class="mt-5">
                <img width="350px" src="{{ asset('images/logo.png') }}"
                     alt="Logo Dark">
                <h1 class="text-white">TimeNet ISP</h1>
                <p class="lead text-white">{!! __('website.homepage.main_text') !!}</p>
            </div>
        </div>
    </div>


    <!-- Services -->
    <div class="container content-space-1">
        <!-- Heading -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
            <span class="h2">{!! __('website.homepage.main_text') !!}</span>
        </div>
        <!-- End Heading -->

        <div class="text-center mb-5">
            {{ __('website.homepage.main_paragraph') }}
        </div>

        <div class="text-center mb-5">
            <!-- List Checked -->
            <ul class="list-inline list-checked list-checked-primary">
                <li class="list-inline-item list-checked-item">{{ __('website.homepage.service_check_1') }}</li>
                <li class="list-inline-item list-checked-item">{{ __('website.homepage.service_check_2') }}</li>
                <li class="list-inline-item list-checked-item">{{ __('website.homepage.service_check_3') }}</li>
            </ul>
            <!-- End List Checked -->
        </div>
        <div class="row mb-5 mb-md-0">
            @foreach($features as $post)
                <div class="col-6 col-lg-4 mb-4 mb-lg-0 mt-3">
                    <!-- Card -->
                    <div class=" card-sm h-100">
                        <div class="p-2 text-center">
                            <img class="card-img"
                                 style="width: 64px;"
                                 src="{{ $post->getFirstMediaUrl('cover') }}"
                                 alt="Image Description">
                        </div>
                        <div class="card-body">
                            <div class="h4 card-title text-center">
                                {{ $post->title }}
                            </div>
                        </div>
                    </div>

                    <!-- End Card -->
                </div>
            @endforeach
        </div>

        <!-- End Row -->
    </div>
    <!-- End Services-->

    <!-- Who works with us -->
    <div class="container content-space-2">
        <!-- Heading -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-6">
            <span class="h2">{{ __('website.homepage.who_works_with_us') }}</span>
        </div>
        <!-- End Heading -->

        <div class="row justify-content-center text-center">
            @foreach($partners as $partner)
                <div class="col-4 col-sm-3 col-md-2 py-3">
                    <img class="avatar avatar-lg avatar-4x3 avatar-centered"
                         src="{{ $partner->getFirstMediaUrl('image') }}" alt="Logo">
                </div>
            @endforeach
        </div>
        <!-- End Row -->
    </div>
    <!-- End Who works with us -->

    <div class="container">
        <div class="bg-img-start rounded-2 p-5 mb-5"
             style="background-image: url({{ asset('images/wallpapers/7.jpg') }});">
            <div class="row align-items-md-center">
                <div class="col-sm mb-3 mb-md-0">
                    <span class="h4 mb-0">{{ __('website.homepage.store_slogan_1') }}</span>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <a class="btn btn-dark btn-sm btn-transition rounded-pill" href="{{ route('store.index') }}">
                        {{ __('website.homepage.shop_now') }}
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>

    <!-- Articles -->
    <div class="container content-space-2">
        <!-- Heading -->
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
            <span class="h2">{{ __('website.homepage.article_section_headline') }}</span>
        </div>
        <!-- End Heading -->

        <div class="overflow-hidden">
            <div class="row gx-lg-7">

                @foreach($articles as $post)
                    <div class="col-sm-6 col-lg-4 mb-5">
                        <!-- Card -->
                        <a class="card card-flush h-100 aos-init aos-animate"
                           href="{{ route('posts.show', $post->slug) }}" data-aos="fade-up">
                            <img class="card-img"
                                 src="{{ $post->getFirstMediaUrl('cover') }}"
                                 alt="Image Description">
                            <div class="card-body">
                                <span class="card-subtitle text-body">{{ __('website.homepage.read_the_article') }}</span>
                                <div class="h4 card-title text-inherit">{{ $post->title }}</div>
                                <p class="card-text text-body">{{ $post->short_content }}</p>
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                @endforeach

            </div>
            <!-- End Row -->
        </div>

        <!-- Card Info -->
        <div class="text-center">
            <div class="card card-info-link card-sm">
                <div class="card-body">
                    {{ __('website.homepage.read_more')  }}
                    <a class="card-link ms-2" href="{{ route('posts.index', ['grid_type' => 'grid', 'slug' => 'articles']) }}">
                        {{ __('website.homepage.read_more_click_here') }}
                        <span class="bi-chevron-right small ms-1"></span></a>
                </div>
            </div>
        </div>
        <!-- End Card Info -->
    </div>
    <!-- End Articles -->

    <div class="container content-space-b-2">
        <div class="bg-img-start rounded-2 p-5 mb-5"
             style="background-image: url({{ asset('images/wallpapers/10.jpg') }});">
            <div class="row align-items-md-center">
                <div class="col-sm mb-3 mb-md-0">
                    <span class="h4 mb-0">{{ __('website.homepage.store_slogan_2') }}</span>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <a class="btn btn-dark btn-sm btn-transition rounded-pill" href="{{ route('store.index') }}">
                        {{ __('website.homepage.shop_now') }}
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
@endsection
