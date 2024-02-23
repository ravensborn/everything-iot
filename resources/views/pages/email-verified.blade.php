@extends('layouts.master')


@section('content')



    <div class="container content-space-1 content-space-lg-2">
        <div class="row">
            <div class="col text-center">

                <div class="w-50 mx-md-auto">

                    <i class="bi bi-check2-circle display-1 text-dark"></i>

                    <div class="mb-5">
                        <h1 class="h2">{{ __('website.verify_email.title') }}</h1>
                        <p>
                            {{ __('website.verify_email.description') }}
                        </p>
                    </div>
                    <a class="btn btn-dark btn-transition rounded-pill px-6"
                       href="{{ route('home') }}"> {{ __('website.verify_email.continue') }}</a>


                    <div class="mt-4"></div>

                    <a class="link text-muted d-block" href="{{ route('users.account.overview') }}">
                        <i class="bi-chevron-left small ms-1"></i>
                        {{ __('website.verify_email.user_account') }}
                    </a>
                    <a class="link text-muted d-block" href="{{ route('store.index') }}">
                        <i class="bi-chevron-left small ms-1"></i>
                        {{ __('website.verify_email.timenet_store') }}
                    </a>

                </div>


            </div>
        </div>
    </div>

@endsection
