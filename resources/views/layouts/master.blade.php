<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if( config('app.available_locales')[app()->getLocale()]['rtl'] ) dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Basic meta info -->
    <meta name="description"
          content="TimeNet Company is a proficient network specialist, primarily dedicated to furnishing top-notch internet accessibility. Specializing in the provisioning of internet access, TimeNet has established itself as a reliable industry player. Their adept team and cutting-edge solutions ensure seamless connectivity, catering to diverse client needs. With a commitment to excellence, TimeNet remains at the forefront of innovative networking, consistently delivering reliable and high-speed internet solutions. Clients rely on TimeNet's expertise to navigate the intricate realm of connectivity, making them an indispensable partner in today's digital landscape. Through their relentless pursuit of quality, TimeNet continues to shape the future of internet provision.">
    <meta name="keywords" content="TimeNet, Internet, ISP, Store, Network Store, Network Devices, Switch, Router, Hub, Cable, Fiber, Iraq Network, Kurdistan Network, Kurdistan Internet, Kurdistan Router, Kurdistan Network Devices">
    <meta name="author" content="Yad Hoshyar">

    <!--OpenGraph meta -->
    @if(isset($openGraphData))

        <meta property="og:title" content="{{ $openGraphData['title'] }}"/>
        <meta property="og:image" content="{{ $openGraphData['image'] }}"/>
        <meta property="og:description" content="{{ $openGraphData['description'] }}"/>
        <meta property="og:url" content="{{ $openGraphData['url'] }}"/>
        <meta property="og:type" content="website"/>

    @else

        <meta property="og:title" content="TimeNet"/>
        <meta property="og:image" content="{{ asset('images/logo-dark.png') }}"/>
        <meta property="og:description" content="TimeNet Company is a proficient network specialist, primarily dedicated to furnishing top-notch internet accessibility. Specializing in the provisioning of internet access, TimeNet has established itself as a reliable industry player. Their adept team and cutting-edge solutions ensure seamless connectivity, catering to diverse client needs. With a commitment to excellence, TimeNet remains at the forefront of innovative networking, consistently delivering reliable and high-speed internet solutions. Clients rely on TimeNet's expertise to navigate the intricate realm of connectivity, making them an indispensable partner in today's digital landscape. Through their relentless pursuit of quality, TimeNet continues to shape the future of internet provision."/>
        <meta property="og:url" content="{{ config('env.APP_URL') }}"/>
        <meta property="og:image:width" content="1276" />
        <meta property="og:image:height" content="539"/>
        <meta property="og:type" content="website"/>

    @endif

    <!-- Title -->
    <title>{{ isset($title) ? 'TimeNet | ' . $title : 'TimeNet ISP' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-dark.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-dark.png') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/snippets.min.css') }}">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('themes/front/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/vendor/swiper/swiper-bundle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            /*--bs-body-bg: #f7faff !important;*/
        }

        .homepage-main-banner {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/wallpapers/RUT200-social-alt-share.png') }}');
            {{--background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/wallpapers/6.jpg') }}');--}}
            background-position: center 70%;
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

            .breadcrumb, .breadcrumb-item .list-inline-item {
                direction: ltr;
            }
        </style>

    @endif

    @livewireStyles
</head>

<body>

@if(request()->routeIs('home'))
    @include('partial-components.home.header-homepage')
@else
    @include('partial-components.home.header')
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
    })()
</script>

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts/>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/64aa7865cc26a871b0274225/1h4sucjkp';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
