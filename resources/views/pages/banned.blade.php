@extends('layouts.master')


@section('content')

    <div class="container content-space-1 content-space-lg-2">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 text-center">

                <div>

                    <i class="bi bi-person-lock display-1 text-dark"></i>

                    <div class="mb-5">
                        <h1 class="h2">{{ __('website.ban_page.title') }}</h1>
                        <p>
                            {{ __('website.ban_page.description_1') }}
                        </p>
                        <p>
                            {{ __('website.ban_page.description_2') }}
                        </p>
                    </div>
                    <a class="btn btn-dark btn-transition rounded-pill px-6"
                       href="{{ route('home') }}">{{ __('website.ban_page.return_home') }}</a>


                    <div class="mt-4"></div>

                    <a class="link text-muted d-block" href="{{ route('logout') }}">
                        <i class="bi-chevron-left small ms-1"></i>
                        {{ __('website.ban_page.logout') }}
                    </a>

                </div>


            </div>
        </div>
    </div>

@endsection
