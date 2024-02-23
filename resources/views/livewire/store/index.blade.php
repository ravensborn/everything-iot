<div>


    <div class="content-space-b-1 store-main-banner"
         style="background-image: {{ $bannerArray['backgroundOverlay'] }} url('{{ $bannerArray['image'] }}'); background-position: {{ $bannerArray['backgroundPosition'] }};">
        <div
            class="container d-md-flex align-items-md-center vh-md-70 content-space-t-4 content-space-b-3 content-space-md-0">
            <div class="mt-5">
                <h1 class="text-white">{{ __('website.store.main_text') }}</h1>
                <p class="text-white-70 w-75" style="font-size: 16.5px;">
                    {{ __('website.store.main_paragraph') }}
                </p>
                <a class="btn btn-dark text-white btn-transition" href="{{ route('store.products.index') }}"
                   style="font-size: 16.5px;">{{ __('website.store.browse_products_button') }}</a>
            </div>
        </div>
    </div>

    <div class="container content-space-b-1" wire:ignore>
        <div class="position-relative">
            <!-- Swiper Main Slider -->
            <div class="js-swiper-shop-classic-hero swiper">
                <div class="swiper-wrapper">


                    @foreach(__('website.store.slides') as $slide)
                        <!-- Slide -->
                        <div class="swiper-slide">
                            <!-- Container -->
                            <div class="container content-space-t-2 content-space-b-3">
                                <div class="row align-items-lg-center">
                                    <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                                        <div class="mb-6">
                                            <div class="display-6 mb-4">{{ $slide['title'] }}</div>
                                            <p>
                                                {{ $slide['description'] }}
                                            </p>
                                        </div>

                                        <div class="d-flex gap-2">

                                        </div>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-lg-6 order-lg-1">
                                        <div class="w-75 mx-auto">
                                            <img class="img-fluid"
                                                 src="{{ $slide['image'] }}"
                                                 alt="Image Description">
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                            <!-- End Container -->
                        </div>
                        <!-- End Slide -->
                    @endforeach

                </div>
            </div>
            <!-- End Swiper Main Slider -->
            <!-- Swiper Thumbs Slider -->
            <div class="position-absolute bottom-0 start-0 end-0 mb-3">
                <div class="js-swiper-shop-hero-thumbs swiper" style="max-width: 13rem;">
                    <div class="swiper-wrapper">


                        @foreach(__('website.store.slides') as $slide)
                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a class="js-swiper-thumb-progress swiper-thumb-progress-avatar" href="javascript:;"
                                   tabindex="0">
                                    <img class="swiper-thumb-progress-avatar-img"
                                         src="{{ $slide['image'] }}"
                                         alt="Image Description">
                                </a>
                            </div>
                            <!-- End Slide -->
                        @endforeach


                    </div>
                </div>
            </div>
            <!-- End Swiper Thumbs Slider -->
        </div>
    </div>

    <div class="border-bottom"></div>

    <div class="content-space-b-1"></div>

    <div class="container content-space-b-1">
        <div class="row">
            <div class="col-md-4 mb-7 mb-md-0">
                <!-- Icon Block -->
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img class="avatar avatar-4x3"
                             src="{{ asset('themes/front/assets/svg/illustrations/oc-protected-card.svg') }}"
                             alt="Image Description">
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h4 class="mb-1">{{ __('website.store.secure_checkout')['title'] }}</h4>
                        <p class="small mb-0">{{ __('website.store.secure_checkout')['description'] }}</p>
                    </div>
                </div>
                <!-- End Icon Block -->
            </div>
            <!-- End Col -->

            <div class="col-md-4 mb-7 mb-md-0">
                <!-- Icon Block -->
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img class="avatar avatar-4x3"
                             src="{{ asset('themes/front/assets/svg/illustrations/oc-return.svg') }}"
                             alt="Image Description">
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h4 class="mb-1">{{ __('website.store.30_days_return')['title'] }}</h4>
                        <p class="small mb-0">{{ __('website.store.30_days_return')['description'] }}</p>
                    </div>
                </div>
                <!-- End Icon Block -->
            </div>
            <!-- End Col -->

            <div class="col-md-4">
                <!-- Icon Block -->
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img class="avatar avatar-4x3"
                             src="{{ asset('themes/front/assets/svg/illustrations/oc-truck.svg') }}"
                             alt="Image Description">
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h4 class="mb-1">{{ __('website.store.fast_shipping')['title'] }}</h4>
                        <p class="small mb-0">{{ __('website.store.fast_shipping')['description'] }}</p>
                    </div>
                </div>
                <!-- End Icon Block -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

    <div class="bg-light">
        <div class="container content-space-2">
            <div class="w-md-75 w-lg-50 text-center mx-md-auto">
                <div class="row justify-content-lg-between">
                    <!-- Heading -->
                    <div class="mb-5">
                        {{--                        <span class="text-cap">Subscribe</span>--}}
                        <h2>{{ __('website.components.subscribe_box.title') }}</h2>
                    </div>
                    <!-- End Heading -->

                    @livewire('global-components.subscribe-box', ['type' => 2])

                    {!! __('website.components.subscribe_box.read_privacy_policy') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="container content-space-2">
        <div class="row">
            @foreach($partners as $partner)
                <div class="col-4 col-sm-3 col-md-2 py-3">
                    <img class="avatar avatar-lg avatar-4x3 avatar-centered"
                         src="{{ $partner->getFirstMediaUrl('image') }}" alt="Logo">
                </div>
            @endforeach
        </div>
        <!-- End Row -->
    </div>

</div>
