@extends('layouts.master')

@section('content')

    <div class="container content-space-1 content-space-lg-2">
        <div class="row">
            <div class="col text-center">

                <div class="w-50 mx-md-auto">

                    <i class="bi bi-envelope-check display-1 text-dark"></i>

                    <div class="mb-3">
                        <h1 class="h2">E-Mail Verification Required!</h1>

                        <div class="mt-3">

                            <div>
                                @if (session()->get('message'))
                                    <div class="text-dark fw-bold mb-3" role="alert">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                            </div>

                            {!! __('Before proceeding, please check your email at <span class="fw-bold">'.  auth()->user()->email .'</span> for a verification link.') !!}

                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                                .
                            </form>
                        </div>


                    </div>


                    <div class="mt-4"></div>

                    <a class="link text-muted d-block" href="{{ route('home') }}">
                        <i class="bi-chevron-left small ms-1"></i>
                        Back to home
                    </a>

                </div>


            </div>
        </div>
    </div>
@endsection
