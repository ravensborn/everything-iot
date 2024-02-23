 <!-- Sticky Footer -->

{{--<div style="position: fixed; bottom: 0;right: 0;width: 300px; z-index: 10000;">--}}
{{--    <div style="padding: 5px;">--}}
{{--        <div style="margin: 0 auto; background-color: #ffa726; color: black; border: 3px solid black; padding: 20px; border-radius: 10px;">--}}
{{--            This website is undergoing to a major renovation please visit us later.--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- ========== FOOTER ========== -->
<footer class="bg-dark">
    <div class="container pb-1 pb-lg-5">
        <div class="row content-space-t-2">
            <div class="col-12 col-lg-3 mb-7 mb-lg-0">
                <!-- Logo -->
                <div class="mb-5">
                    <a class="navbar-brand" href="{{ route('home') }}" aria-label="Space">
                        <img class="navbar-brand-logo" src="{{ asset('images/logo.png') }}" alt="Image Description">
                    </a>
                </div>
                <!-- End Logo -->

                <!-- List -->
                <ul class="list-unstyled list-py-1">
                    <li><a class="link-sm link-light" href="#"><i class="bi-geo-alt-fill me-1"></i> {{ __('website.footer.address') }}</a></li>
                    <li><a class="link-sm link-light" href="tel:+9647503807676"><i class="bi-telephone-inbound-fill me-1"></i> +964 (750) 380-7676</a></li>
                </ul>
                <!-- End List -->

            </div>
            <!-- End Col -->

            <div class="col-6 col-sm mb-7 mb-sm-0">
                <h5 class="text-white mb-3">{{ __('website.footer.company') }}</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-light" href="{{ route('about') }}">{{ __('website.footer.about') }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('posts.index', ['grid_type' => 'grid', 'slug' => 'services']) }}">{{ __('website.footer.services') }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('posts.index', ['grid_type' => 'grid', 'slug' => 'solutions']) }}">{{ __('website.footer.solutions') }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('posts.index', ['grid_type' => 'grid', 'slug' => 'product-catalog']) }}">{{ __('website.footer.catalog') }}</a></li>
                    <li><a class="link-sm link-light" href="tel:9647503807676">{{ __('website.footer.contact_us') }}</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-6 col-sm mb-7 mb-sm-0">
                <h5 class="text-white mb-3">{{ __('website.footer.features') }}</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-light" href="{{ route('store.index') }}">{{ __('website.footer.store') }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('store.products.index') }}">{{ __('website.footer.available_products') }}</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-6 col-sm mb-7 mb-sm-0">
                <h5 class="text-white mb-3">{{ __('website.footer.documentation') }}</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-light" href="{{ route('downloads') }}">{{ __('website.footer.downloads') }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('faq') }}">{{ __('website.footer.faq') }}</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-6 col-sm">
                <h5 class="text-white mb-3">{{ __('website.footer.resources') }}</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-5">
                    <li><a class="link-sm link-light" href="{{ route('soon') }}"><i class="bi-question-circle-fill me-1"></i> {{ __('website.footer.help')  }}</a></li>
                    <li><a class="link-sm link-light" href="{{ route('users.account.overview') }}"><i class="bi-person-circle me-1"></i> {{ __('website.footer.your_account') }}</a></li>
                    @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator')))
                        <li><a class="link-sm link-light" href="{{ route('dashboard.overview') }}"><i class="bi-lightning-charge me-1"></i> Administrator</a></li>
                    @endif
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->

        <div class="border-top border-white-10 my-7"></div>

        <div class="row mb-7">
            <div class="col-sm mb-3 mb-sm-0">
                <!-- Socials -->
                <ul class="list-inline list-separator list-separator-light mb-0">
                    <li class="list-inline-item">
                        <a class="link-sm link-light" href="{{ route('privacy-and-policy') }}">{{ __('website.footer.privacy_and_policy') }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-sm link-light" href="{{ route('terms-and-conditions') }}">{{ __('website.footer.terms') }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-sm link-light" href="{{ asset('sitemap.xml') }}">{{ __('website.footer.sitemap') }}</a>
                    </li>
                </ul>
                <!-- End Socials -->
            </div>

            <div class="col-sm-auto">
                <!-- Socials -->
                <ul class="list-inline mb-0">

                    <li class="list-inline-item">
                        <a class="btn btn-soft-light btn-xs btn-icon" href="https://www.linkedin.com/company/timenet/">
                            <i class="bi-linkedin"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="btn btn-soft-light btn-xs btn-icon" href="https://www.facebook.com/Teknykar">
                            <i class="bi-facebook"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a class="btn btn-soft-light btn-xs btn-icon" href="https://www.instagram.com/time.nett/">
                            <i class="bi-instagram"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a class="btn btn-soft-light btn-xs btn-icon" href="mailto:info@time-net.net">
                            <i class="bi-envelope"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <!-- Button Group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-soft-light btn-xs dropdown-toggle" id="footerDarkSelectLanguage" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                <span class="d-flex align-items-center">
                  <img class="avatar avatar-xss avatar-circle me-2" src="{{ config('app.available_locales')[app()->currentLocale()]['icon'] }}" alt="Image description" width="16"/>
                  <span>{{ config('app.available_locales')[app()->currentLocale()]['name'] }}</span>
                </span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="footerDarkSelectLanguage">

                                @foreach(config('app.available_locales') as $code => $language)
                                    <a class="dropdown-item d-flex align-items-center active" href="{{ route('set-language', $code) }}">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="{{ $language['icon'] }}" alt="Image description" width="16"/>
                                        <span>{{ $language['name'] }}</span>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                        <!-- End Button Group -->
                    </li>
                </ul>
                <!-- End Socials -->
            </div>
        </div>

        <!-- Copyright -->
        <div class="w-md-85 text-lg-center mx-lg-auto">
            <p class="text-white-50 small">{!! __('website.footer.copyright') !!}</p>
            <p class="text-white-50 small">{{ __('website.footer.cookie_warning') }}</p>
        </div>
        <!-- End Copyright -->
    </div>
</footer>
<!-- ========== END FOOTER ========== -->
