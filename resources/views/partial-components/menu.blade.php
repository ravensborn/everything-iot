@foreach($items as $item)

    @if(in_array($item['type'], [\App\Models\Menu::ITEM_TYPE_ROUTE, \App\Models\Menu::ITEM_TYPE_LINK, \App\Models\Menu::ITEM_TYPE_POST]))
        <li class="nav-item">
            <a class="nav-link"
               href="{{ $item['url'] }}">
                @if(\Illuminate\Support\Facades\Lang::has('website.menu.' . $item['name'], session()->get('locale')))
                    {!! trans('website.menu.' . $item['name'])  !!}
                @else
                    {!! $item['name'] !!}
                @endif
            </a>
        </li>
    @endif

    @if(in_array($item['type'], [\App\Models\Menu::ITEM_TYPE_ROUTE_DROPDOWN, \App\Models\Menu::ITEM_TYPE_LINK_DROPDOWN, \App\Models\Menu::ITEM_TYPE_POST_DROPDOWN]))
        <li class="hs-has-sub-menu nav-item">
            <a id="pagesMegaMenu"
               class="hs-mega-menu-invoker nav-link dropdown-toggle text-white-80"
               href="#"
               role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
                @if(\Illuminate\Support\Facades\Lang::has('website.menu.' . $item['name'], session()->get('locale')))
                    {!! trans('website.menu.' . $item['name'])  !!}
                @else
                    {!! $item['name'] !!}
                @endif
            </a>
            <!-- Mega Menu -->
            <div class="hs-sub-menu dropdown-menu" aria-labelledby="pagesMegaMenu"
                 style="min-width: 14rem;">
                @foreach($item['array'] as $subItem)
                    <a class="dropdown-item"
                       href="{{ $subItem['url'] }}">

                        @if(\Illuminate\Support\Facades\Lang::has('website.menu.' . $subItem['name'], session()->get('locale')))
                            {!! trans('website.menu.' . $subItem['name'])  !!}
                        @else
                            {!! $subItem['name'] !!}
                        @endif
                    </a>
                @endforeach
            </div>
            <!-- End Mega Menu -->
        </li>
    @endif

    @if($item['type'] == \App\Models\Menu::ITEM_TYPE_LANG_SWITCHER)
        <li class="hs-has-sub-menu nav-item">
            <a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link dropdown-toggle" href="#"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {!! $item['name'] !!}
            </a>
            <!-- Mega Menu -->
            <div class="hs-sub-menu dropdown-menu" aria-labelledby="pagesMegaMenu"
                 style="min-width: 14rem;">

                @foreach(config('app.available_locales') as $code => $language)
                    <a class="dropdown-item" href="{{ route('set-language', $code) }}">
                        <div class="d-flex align-items-center @if(app()->isLocale($code)) fw-bold @endif">
                            <img style="width: 16px; height: auto;"
                                 src="{{ $language['icon']  }}"
                                 alt="flag icon">
                            &nbsp;
                            {{ $language['name'] }}
                        </div>
                    </a>
                @endforeach


            </div>
            <!-- End Mega Menu -->
        </li>
    @endif
    @if($item['type'] == \App\Models\Menu::ITEM_TYPE_CALL_US_BTN)
        <li class="nav-item">
            <a class="btn btn-light btn-transition btn-sm" href="tel:{{ $item['tel'] }}" target="_blank">
                <i class="bi bi-telephone"></i>
                &nbsp;
                {{ __('website.globals.contact_us') }}
            </a>
        </li>
    @endif

    @if($item['type'] == \App\Models\Menu::ITEM_TYPE_LIVEWIRE_CART)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('store.cartItems.index') }}">
                @livewire('store.cart-items.header-cart-component')
            </a>
        </li>
    @endif

    @if($item['type'] == \App\Models\Menu::ITEM_TYPE_USER_ACCOUNT)
        @if(!auth()->check())

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('website.globals.login') }}</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-light btn-transition btn-sm" href="{{ route('register') }}">
                    {{ __('website.globals.register') }}
                </a>
            </li>

        @else

            <!-- Support -->
            <li class="hs-has-sub-menu nav-item">
                <a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link dropdown-toggle" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __('website.menu.my_account') }}</a>
                <!-- Mega Menu -->
                <div class="hs-sub-menu dropdown-menu" aria-labelledby="pagesMegaMenu"
                     style="min-width: 14rem;">
                    <a class="dropdown-item" href="{{ route('users.account.overview') }}">{{ __('website.menu.profile') }}</a>
                    <a class="dropdown-item" href="{{ route('users.store.orders.index') }}">{{ __('website.menu.orders') }}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">{{ __('website.menu.logout') }}</a>
                </div>
                <!-- End Mega Menu -->
            </li>
            <!-- End Support -->
        @endif
    @endif

@endforeach
