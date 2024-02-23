<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      @if( config('app.available_locales')[app()->getLocale()]['rtl'] ) dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Basic meta info -->
    <meta name="description"
          content="TimeNet Company a network expertise company works in the fields of providing internet access">
    <meta name="keywords" content="TimeNet, Internet, ISP, Store, Network Store, Network Devices, Switch, Router, Hub, Cable, Fiber">
    <meta name="author" content="Yad Hoshyar">

    <!--OpenGraph meta -->
    <meta property="og:description" content="TimeNet Company a network expertise company works in the fields of providing internet access">
    <meta property="og:title" content="TimeNet Company">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ config('env.APP_URL') }}">

    <!-- Title -->
    <title>TimeNet ISP Store</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('themes/front/assets/vendor/swiper/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/snippets.min.css') }}">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('themes/front/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">

    <style>
        .swiper-thumb-progress .swiper-thumb-progress-path {
            stroke: #21325b !important;
        }

        .input-card-pill {
            border-radius: unset;
        }

        input[type="checkbox"] {
            filter: sepia(100%) brightness(80%) hue-rotate(170deg) saturate(70%) contrast(300%);
        }

        .pagination .active span {
            background-color: #21325b;
        }

        .cart-table tbody tr td, .cart-table tbody tr th {
            vertical-align: middle;
        }

        .store-main-banner {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/wallpapers/store-wallpaper.jpg') }}');
            background-position: center 50%;
            background-repeat: no-repeat;
            background-size: cover;
        }




    </style>

    @if( config('app.available_locales')[app()->getLocale()]['rtl'] )

        <style>
            .rtl-mode-direction {
                direction: rtl !important;
            }

            .rtl-mode-text-left {
                text-align: left !important;
            }

            .breadcrumb, .breadcrumb-item, .list-inline-item {
                direction: ltr;
            }
        </style>

    @endif

    @livewireStyles
</head>

<body>

@if(request()->routeIs('store.index'))
    @include('partial-components.store.header-store')
@else
    @include('partial-components.store.header')
@endif

@yield('content')

@include('partial-components.footer')

<!-- JS Global Compulsory -->
<script src="{{ asset('themes/front/assets/vendor/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('themes/front/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script src="{{ asset('themes/front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
    (function () {


        new HSMegaMenu('.js-mega-menu', {
            desktop: {
                position: 'left'
            }
        });

        var sliderThumbs = new Swiper('.js-swiper-shop-hero-thumbs', {
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            history: false,
            slidesPerView: 3,
            spaceBetween: 15,
            on: {
                beforeInit: (swiper) => {
                    const css = `.swiper-slide-thumb-active .swiper-thumb-progress .swiper-thumb-progress-path {
                opacity: 1;
                -webkit-animation: ${swiper.originalParams.autoplay.delay}ms linear 0ms forwards swiperThumbProgressDash;
                animation: ${swiper.originalParams.autoplay.delay}ms linear 0ms forwards swiperThumbProgressDash;
            }`
                    style = document.createElement('style')
                    document.head.appendChild(style)
                    style.type = 'text/css'
                    style.appendChild(document.createTextNode(css));

                    swiper.el.querySelectorAll('.js-swiper-thumb-progress')
                        .forEach(slide => {
                            slide.insertAdjacentHTML('beforeend', '<span class="swiper-thumb-progress"><svg version="1.1" viewBox="0 0 160 160"><path class="swiper-thumb-progress-path" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path></svg></span>')
                        })
                },
            },
        });
        var swiper = new Swiper('.js-swiper-shop-classic-hero', {
            autoplay: true,
            loop: true,
            navigation: {
                nextEl: '.js-swiper-shop-classic-hero-button-next',
                prevEl: '.js-swiper-shop-classic-hero-button-prev',
            },
            thumbs: {
                swiper: sliderThumbs,
                color: 'red'
            }
        });


        var shopProductSliderThumbs = new Swiper('.js-swiper-shop-product-thumb', {
            slidesPerView: 3,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            history: false,
        });

        var shopProductSwiper = new Swiper('.js-swiper-shop-product', {

            autoplay: true,
            loop: true,
            navigation: {
                nextEl: '.js-swiper-shop-product-button-next',
                prevEl: '.js-swiper-shop-product-button-prev',
            },
            thumbs: {
                swiper: shopProductSliderThumbs
            }
        });


    })()
</script>

@livewireScripts

<script>
    Livewire.on('scroll-to-top', () => {
        window.scrollTo({
            top: 15,
            left: 15,
            behaviour: 'smooth'
        })
    })
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts/>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/64aa7865cc26a871b0274225/1h4sucjkp';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
