<div>
    <div class="navbar-expand-lg navbar-light">
        <div id="sidebarNav" class="collapse navbar-collapse navbar-vertical">
            <!-- Card -->
            <div class="card flex-grow-1 mb-5">
                <div class="card-body">
                    <!-- Avatar -->
                    <div class="d-none d-lg-block text-center mb-5">
                        <div class="avatar avatar-xxl avatar-circle mb-3">
                            <img class="avatar-img" src="{{ asset('images/user.png') }}" alt="Image Description">
                        </div>

                        <h4 class="card-title mb-0">{{ ucfirst($user->name) }}</h4>
                        <p class="card-text small">{{ $user->email }}</p>
                    </div>
                    <!-- End Avatar -->

                    <!-- Nav -->
                    <span class="text-cap">{{ __('website.user_section.account') }}</span>

                    <!-- List -->
                    <ul class="nav nav-sm nav-tabs nav-vertical mb-4">
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'overview')]) href="{{ route('users.account.overview') }}">
                                <i class="bi-person-badge nav-icon"></i> {{ __('website.user_section.personal_info') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'security')]) href="{{ route('users.account.security') }}">
                                <i class="bi-shield-shaded nav-icon"></i> {{ __('website.user_section.security') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'notifications')]) href="{{ route('users.account.notifications') }}">
                                <i class="bi-bell nav-icon"></i> {{ __('website.user_section.notifications') }}
                                {{--                                <span class="badge bg-soft-dark text-dark rounded-pill nav-link-badge">1</span>--}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'preferences')]) href="{{ route('users.account.preferences') }}">
                                <i class="bi-sliders nav-icon"></i> {{ __('website.user_section.preferences') }}
                            </a>
                        </li>
                    </ul>
                    <!-- End List -->

                    <span class="text-cap">{{ __('website.user_section.store') }}</span>

                    <!-- List -->
                    <ul class="nav nav-sm nav-tabs nav-vertical mb-4">
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'orders')]) href="{{ route('users.store.orders.index') }}">
                                <i class="bi-basket nav-icon"></i> {{ __('website.user_section.your_orders') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link',  'active' => ($navbarPage == 'wishlist')]) href="{{ route('users.store.wishlist') }}">
                                <i class="bi-heart nav-icon"></i> {{ __('website.user_section.wishlist') }}
{{--                                <span class="badge bg-soft-dark text-dark rounded-pill nav-link-badge">2</span>--}}
                            </a>
                        </li>
                    </ul>
                    <!-- End List -->

                    <div class="d-lg-none">
                        <div class="dropdown-divider"></div>

                        <!-- List -->
                        <ul class="nav nav-sm nav-tabs nav-vertical">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi-box-arrow-right nav-icon"></i> {{ __('website.user_section.logout') }}
                                </a>
                            </li>
                        </ul>
                        <!-- End List -->
                    </div>
                    <!-- End Nav -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
