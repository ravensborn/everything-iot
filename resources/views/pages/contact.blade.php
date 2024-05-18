@extends('layouts.master')


@section('content')

    <!-- Breadcrumb -->
    <div class="bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-sm">
                    <h4 class="mb-0">{{ __('website.breadcrumb.support') }}</h4>
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
                                {{ __('website.breadcrumb.support') }}
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

    <div class="container content-space-t-2">
        <!-- Heading -->
        <div class="text-center mx-md-auto mb-5">
            <h2>{{ __('website.support.contact_us') }}</h2>

            <p>

            </p>

            <p>
                <a href="mailto:sales@time-net.net">
                    <i class="bi bi-envelope"></i>
                    sales@time-net.net
                </a>
                &nbsp;
                <a href="tel:+9647503807676">
                    <i class="bi bi-telephone"></i>
                    +964 (750) 380-7676
                </a>
            </p>

            <hr>
        </div>

    </div>
    <div class="container">
        <hr>
    </div>
    <div class="container content-space-b-2" id="support-form">
        <div class="bg-dark rounded-2"
             style="background-image: url('{{ asset('themes/front/assets/svg/components/wave-pattern-light.svg') }}');">
            <div class="container-xl container-fluid content-space-1 content-space-md-2 px-4 px-md-8 px-lg-10">
                <div class="row justify-content-lg-between align-items-lg-center">
                    <div class="col-md-10 col-lg-5 mb-9 mb-lg-0">
                        <!-- Info -->
                        <h1 class="text-white">{{ __('website.support.contact_us_now') }}</h1>
                        <p class="text-white-70">{{ __('website.support.form_text_1') }}</p>
                        <!-- End Info -->

                        <div class="border-top border-white-10 my-5" style="max-width: 10rem;"></div>

                        <!-- Blockquote -->
                        <figure>
                            <div class="mb-4">
                                <img class="avatar avatar-xl avatar-4x3" src="{{ asset('images/logo.png') }}"
                                     alt="Logo">
                            </div>

                            <blockquote class="blockquote blockquote-light">
                                {{ __('website.support.form_text_2') }}
                            </blockquote>

                        </figure>
                        <!-- End Blockquote -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Card -->
                        <div class="card card-lg">
                            <div class="card-body">
                                <div class="mb-4">
                                    @if(session()->has('success_message'))
                                        <div class="alert alert-success">
                                            {{ __('website.support.message_received') }}
                                        </div>
                                    @endif
                                    <h3 class="card-title">{{ __('website.support.fill_out_the_form') }}</h3>
                                </div>

                                <!-- Form -->
                                <form method="POST" action="{{ route('support-send-email') }}">
                                    @csrf
                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <!-- Form -->
                                            <div class="mb-3">
                                                <label class="form-label visually-hidden" for="name">{{ __('website.support.name') }}</label>
                                                <input type="text" class="form-control form-control-lg" name="name"
                                                       id="name" placeholder="{{ __('website.support.name') }}" aria-label="Name">
                                                @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <!-- End Form -->
                                        </div>
                                        <!-- End Col -->
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <!-- Form -->
                                            <div class="mb-3">
                                                <label class="form-label visually-hidden" for="email">{{ __('website.support.email') }}</label>
                                                <input type="email" class="form-control form-control-lg" name="email"
                                                       id="email" placeholder="email@site.com"
                                                       aria-label="email@site.com">
                                                @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <!-- End Form -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->


                                    <!-- Form -->
                                    <div class="mb-3">
                                        <label class="form-label visually-hidden"
                                               for="hireUsFormDetails">{{ __('website.support.details') }}</label>
                                        <textarea class="form-control form-control-lg" name="message"
                                                  id="hireUsFormDetails" placeholder="{{ __('website.support.details_placeholder') }}"
                                                  aria-label="Tell us about your project" rows="4"></textarea>
                                        @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- End Form -->


                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-lg">{{ __('website.support.send') }}</button>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
