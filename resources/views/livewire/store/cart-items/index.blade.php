<div>

    <!-- Breadcrumb -->
    <div class="bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-sm">
                    <h4 class="mb-0">{{ __('website.breadcrumb.timenet_store') }}</h4>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">{{ __('website.breadcrumb.timenet') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('store.index') }}">{{ __('website.breadcrumb.store') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('website.breadcrumb.shopping_cart') }}</li>
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

    @if(auth()->check())
        @if($cartItems->count() > 0)
            <div class="container content-space-1 content-space-lg-2">
                <div class="row">
                    <div class="col-lg-8 mb-7 mb-lg-0">
                        <!-- Heading -->
                        <div class="d-flex justify-content-between align-items-end border-bottom pb-3 mb-7">
                            <h1 class="h3 mb-0">{{ __('website.cart.shopping_cart') }}</h1>
                            <span>{{ $cartItems->count() }} {{ $cartItems->count() > 1 ?  __('website.cart.items') :  __('website.cart.item')  }}</span>
                        </div>
                        <!-- End Heading -->

                        <!-- Form -->
                        <form>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-no-gutters mb-5">
                                @foreach($cartItems as $item)
                                    <!-- Item -->
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
{{--                                                <img class="avatar avatar-xl avatar-4x3"--}}
{{--                                                     src="{{ $item->product->getMedia('images')->where('uuid', $item->product->cover_uuid)->first()->getFullUrl() }}"--}}
{{--                                                     alt="Image Description">--}}
                                                <i class="bi bi-box"></i>
                                            </div>

                                            <div class="flex-grow-1 ms-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 mb-3 mb-sm-0">
                                                        <h5>
                                                            <a class="text-dark" href="#">{{ $item->product->name }}</a>
                                                        </h5>
                                                        @if($item->checkStockAvailability())
                                                            <h6 class="text-success">Available in stock</h6>
                                                        @else
                                                            <h6 class="text-danger">Item out of stock</h6>
                                                        @endif

                                                        <div class="d-block d-sm-none">
                                                            <h5 class="mb-1">{{ $item->quantity }} X
                                                                ${{ number_format($item->product->price, 2) }}</h5>
                                                        </div>
                                                    </div>
                                                    <!-- End Col -->

                                                    <div class="col-6 col-md-3">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <button type="button"
                                                                        class="btn fs-3 m-0 p-0 border-none"
                                                                        wire:click="updateQuantity({{ $item->product->id }}, 'increment')">
                                                                    <i class="bi-plus-square"></i>
                                                                </button>
                                                                {{ $item->quantity }}
                                                                <button type="button"
                                                                        class="btn fs-3 m-0 p-0 border-none"
                                                                        wire:click="updateQuantity({{ $item->product->id }}, 'decrement')">
                                                                    <i class="bi-dash-square"></i>
                                                                </button>

                                                                <div>
                                                                    <a class="link-sm link-secondary small"
                                                                       wire:click="updateQuantity({{ $item->product->id }}, 'delete')"
                                                                       style="cursor:pointer;">
                                                                        <i class="bi-trash me-1"></i> {{ __('website.store.remove') }}
                                                                    </a>
                                                                </div>

                                                                <div>
                                                                    @if($user && $user->wishlist()->where('product_id', $item->product_id)->first())
                                                                        <a class="link-sm link-secondary small text-danger"
                                                                           style="cursor:pointer;"
                                                                           wire:click="toWishlist({{ $item->product_id }}, 'remove')">
                                                                            <i class="bi-heart-fill text-danger me-1"></i>
                                                                            {{ __('website.store.save_for_later') }}
                                                                        </a>
                                                                    @else
                                                                        <a class="link-sm link-secondary small"
                                                                           style="cursor:pointer;"
                                                                           wire:click="toWishlist({{ $item->product_id }}, 'add')">
                                                                            <i class="bi-heart me-1"></i> {{ __('website.store.save_for_later') }}
                                                                        </a>
                                                                    @endif
                                                                </div>

                                                            </div>


                                                            <!-- End Col -->
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>
                                                    <!-- End Col -->

                                                    <div class="col-6 col-md-3 d-none d-sm-inline-block text-right">
                                                        <span class="h5 d-block mb-1 text-muted">{{ $item->quantity }} X ${{ number_format($item->product->price, 2) }}</span>
                                                        <span
                                                            class="h5 d-block mb-1">${{ number_format($item->quantity * $item->product->price, 2) }}</span>
                                                    </div>
                                                    <!-- End Col -->
                                                </div>
                                                <!-- End Row -->
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End Item -->
                                @endforeach


                            </ul>
                            <!-- End List Group -->

                            <div class="d-sm-flex justify-content-end">
                                <a class="link text-dark" href="{{ route('store.products.index') }}">
                                    <i class="bi-chevron-left small ms-1"></i> {{ __('website.cart.continue_shopping')  }}
                                </a>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Col -->

                    <div class="col-lg-4">
                        <div class="ps-lg-4">
                            <!-- Card -->
                            <div class="card card-sm shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="border-bottom pb-4 mb-4">
                                        <h3 class="card-header-title">{{ __('website.cart.order_summary') }}</h3>
                                    </div>

                                    <form>
                                        <div class="border-bottom pb-4 mb-3">
                                            <input type="text"
                                                   class="form-control @if($promoCodeStatus == 'invalid') is-invalid @endif  @if($promoCodeStatus == 'invalid') is-valid @endif"
                                                   name="name"
                                                   wire:model="promoCode"
                                                   placeholder="{{ __('website.cart.enter_promo_code') }}" aria-label="Enter promo code">
                                            @if($promoCodeStatus == 'invalid')
                                                <small class="text-danger">{{ __('website.cart.invalid_code') }}</small>
                                            @endif
                                            @if($promoCodeStatus == 'valid')
                                                <small class="text-success">{{ __('website.cart.code_applied') }}</small>
                                            @endif
                                        </div>

                                        <div class="border-bottom pb-4 mb-4">
                                            <div class="d-grid gap-3">
                                                <dl class="row">
                                                    <dt class="col-sm-6">{{ __('website.cart.item_subtotal') }} ({{ $cartItems->count() }})</dt>
                                                    <dd class="col-sm-6 text-sm-end mb-0">
                                                        ${{ number_format($cartTotal, 2) }}</dd>
                                                </dl>
                                                <!-- End Row -->

                                                @if($promoCodeData)
                                                    <dl class="row">
                                                        <dt class="col-sm-6">{{ __('website.cart.enter_promo_code') }}
                                                        </dt>
                                                        <dd class="col-sm-6 text-sm-end mb-0 text-danger">
                                                            @if($promoCodeData->discount_type == \App\Models\PromoCode::DISCOUNT_TYPE_FIXED)
                                                               - ${{ number_format($promoCodeData->discount_amount, 2) }}
                                                            @endif
                                                            @if($promoCodeData->discount_type == \App\Models\PromoCode::DISCOUNT_TYPE_PERCENTAGE)
                                                                    - %{{ $promoCodeData->discount_amount }} (${{ ($promoCodeData->discount_amount / 100) * $cartTotal }})
                                                            @endif
                                                        </dd>
                                                    </dl>
                                                    <!-- End Row -->
                                                @endif

                                                <dl class="row">
                                                    <dt class="col-sm-6">{{ __('website.cart.delivery') }}</dt>
                                                    <dd class="col-sm-6 text-sm-end mb-0">---</dd>
                                                </dl>
                                                <!-- End Row -->
                                            </div>
                                        </div>

                                        <div class="d-grid gap-3 mb-4">
                                            <!-- End Row -->

                                            <dl class="row">
                                                <dt class="col-sm-6">{{ __('website.cart.total') }}</dt>
                                                <dd class="col-sm-6 text-sm-end mb-0">
                                                    ${{  number_format($totalPay, 2) }}</dd>
                                            </dl>
                                            <!-- End Row -->
                                        </div>

                                        <div class="d-grid">
                                            <a class="btn btn-dark btn-lg" wire:click.prevent="checkout()">{{ __('website.cart.checkout_button') }}</a>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Card -->
                            </div>

                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        @else
            <div class="container content-space-1 content-space-lg-2">
                <div class="w-md-75 w-lg-50 text-center mx-md-auto">
                    <div class="mb-2">
                        {{--                        <img class="img-fluid" src="{{ asset('themes/front/assets/svg/illustrations/oc-empty-cart.svg') }}" alt="Empty cart" style="width: 15rem;">--}}
                        <i class="bi bi-cart-dash text-dark fw-bold display-1"></i>
                    </div>

                    <div class="mb-5">
                        <h1 class="h2">{{ __('website.cart.empty_cart') }}</h1>
                        <p>{{ __('website.cart.empty_cart_description') }}</p>
                    </div>

                    <a class="btn btn-dark btn-transition rounded-pill px-6" href="{{ route('store.products.index') }}">
                        {{ __('website.cart.start_shopping') }}
                    </a>
                </div>
            </div>
        @endif
    @else

        <div class="container content-space-1 content-space-lg-2">
            <div class="row">
                <div class="col text-center">

                    <div class="w-50 mx-md-auto">

                        <i class="bi bi-shield-lock display-1 text-dark"></i>

                        <div class="mb-5">
                            <h1 class="h2">{{ __('website.cart.login_required') }}</h1>
                            <p>
                                {{ __('website.cart.login_required_description') }}
                            </p>
                        </div>
                        <a class="btn btn-dark btn-transition rounded-pill px-6" href="{{ route('login') }}">{{ __('website.cart.login_slash_register') }}</a>


                        <div class="mt-4"></div>


                        <a class="link text-muted d-block" href="{{ route('home') }}">
                            <i class="bi-chevron-left small ms-1"></i>
                            {{ __('website.checkout.back_to_home') }}
                        </a>

                    </div>


                </div>
            </div>
        </div>

    @endif


</div>
