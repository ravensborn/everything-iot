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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('website.breadcrumb.checkout') }}</li>
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
        @if(!$success)
            <div class="container content-space-1 content-space-lg-2">
                <div class="row">
                    <div class="col-lg-8 mb-7 mb-lg-0">
                        <h4 class="mb-3">{{ __('website.checkout.shipping_address') }}</h4>

                        <!-- Form -->
                        <form id="checkout-form">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="checkoutFirstName" class="form-label">{{ __('website.checkout.first_name') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="checkoutFirstName"
                                           placeholder="{{ __('website.checkout.first_name') }}"
                                           wire:model="checkoutFirstName">
                                    @error('checkoutFirstName')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-6">
                                    <label for="checkoutLastName" class="form-label">{{ __('website.checkout.last_name') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="checkoutLastName"
                                           placeholder="{{ __('website.checkout.last_name') }}"
                                           wire:model="checkoutLastName">
                                    @error('checkoutLastName')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-12">
                                    <label for="checkoutEmail" class="form-label">{{ __('website.checkout.email') }}</label>
                                    <input type="email" class="form-control form-control-lg" id="checkoutEmail"
                                           placeholder="you@example.com" wire:model="checkoutEmail">
                                    @error('checkoutEmail')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-6">
                                    <label for="checkoutPrimaryPhoneNumber" class="form-label">{{ __('website.checkout.second_phone_number') }}</label>
                                    <input type="tel" class="form-control form-control-lg"
                                           id="checkoutPrimaryPhoneNumber"
                                           placeholder="+9647501234567" wire:model="checkoutPrimaryPhoneNumber">
                                    @error('checkoutPrimaryPhoneNumber')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-6">
                                    <label for="checkoutSecondaryPhoneNumber" class="form-label">{{ __('website.checkout.second_phone_number') }}</label>
                                    <input type="tel" class="form-control form-control-lg"
                                           id="checkoutSecondaryPhoneNumber"
                                           placeholder="+9647507654321" wire:model="checkoutSecondaryPhoneNumber">
                                    @error('checkoutSecondaryPhoneNumber')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-12">
                                    <label for="checkoutAddress" class="form-label">{{ __('website.checkout.address') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="checkoutAddress"
                                           placeholder="Main Area, 44001, Erbil, KRI" wire:model="checkoutAddress">
                                    @error('checkoutAddress')
                                    <small class="text-danger mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="col-md-5">
                                    <label for="checkoutCountry" class="form-label">{{ __('website.checkout.country') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="checkoutCountry"
                                           value="{{ $user->country->name }}" readonly>
                                </div>

                                <!-- End Col -->

                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <!-- Check -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sameAddressShopCheckout" checked
                                           onclick="event.preventDefault();" readonly>
                                    <label class="form-check-label" for="sameAddressShopCheckout">{{ __('website.checkout.shipping_address') }}</label>
                                </div>
                                <!-- End Check -->
                            </div>

                            <hr class="my-4">

                            <h4 class="mb-3">{{ __('website.checkout.payment') }}</h4>

                            <div>


                                <div wire:loading wire:target="selectPaymentMethod">
                                      <span class="spinner-border spinner-border-sm me-1" role="status"
                                            aria-hidden="true"></span>
                                    <span class="visually-hidden">Loading...</span>
                                    {{ __('website.checkout.payment_method_switch') }}
                                </div>

                                @foreach($paymentMethods as $payment)

                                    @if($payment->enabled)

                                        <div wire:click="selectPaymentMethod({{ $payment->id }})"
                                             style="cursor:pointer;"
                                             class="rounded p-3 my-2 shadow shadow-sm @if($selectedPaymentMethod->id == $payment->id) border border-2 border-dark @endif">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $payment->getFirstMediaUrl('icon') }}"
                                                         style="width: 48px; height: auto;"
                                                         alt="Payment Method Icon">
                                                    &nbsp;
                                                    &nbsp;
                                                    <span @class(['fw-bold' => ($selectedPaymentMethod->id == $payment->id)])>{{ $payment->name }}</span>
                                                </div>

                                                <div class="badge text-body"
                                                     @class(['fw-bold' => ($selectedPaymentMethod->id == $payment->id), 'text-muted text-start' => true ]) style="width: 150px;">
                                                    {{ __('website.checkout.payment_method_fee') }}
                                                    @if($payment->fee_type == \App\Models\PaymentMethod::FEE_TYPE_PERCENTAGE)
                                                        {{ $payment->fee }}%
                                                    @else
                                                        ${{ $payment->fee }}
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <div style="cursor: not-allowed;"
                                             class="rounded p-3 my-2 shadow shadow-sm">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="{{ $payment->getFirstMediaUrl('icon') }}"
                                                             style="width: 48px; height: auto;"
                                                             alt="Payment Method Icon">
                                                    </div>
                                                    &nbsp;
                                                    &nbsp;
                                                    <div>{{ $payment->name }}</div>
                                                </div>
                                                <div class="badge text-danger" style="width: 150px;">
                                                    {{ __('website.checkout.payment_method_disabled') }}
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                @endforeach
                            </div>

                            <!-- End Row -->
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

                                        <div class="border-bottom pb-4 mb-4">
                                            <div class="d-grid gap-3">
                                                <dl class="row">
                                                    <dt class="col-sm-6">{{ __('website.checkout.item_subtotal') }} ({{ $cartItems->count() }})</dt>
                                                    <dd class="col-sm-6 text-sm-end mb-0">
                                                        ${{ number_format($cartTotal, 2) }}</dd>
                                                </dl>
                                                <!-- End Row -->

                                                <dl class="row">
                                                    <dt class="col-sm-6">{{ __('website.checkout.shipping_address') }}</dt>
                                                    @if($shippingRate)
                                                        <dd class="col-sm-6 text-sm-end mb-0">${{ $shippingRate }}</dd>
                                                    @else
                                                        <dd class="col-sm-6 text-sm-end mb-0">Free</dd>
                                                    @endif

                                                </dl>

                                                @if($selectedPaymentMethod)
                                                    <dl class="row">
                                                        <dt class="col-sm-6">{{ __('website.checkout.payment_method_fee') }}</dt>
                                                        @if($selectedPaymentMethod->fee_type == \App\Models\PaymentMethod::FEE_TYPE_PERCENTAGE)
                                                            <dd class="col-sm-6 text-sm-end mb-0">
                                                                {{ $selectedPaymentMethod->fee }}%
                                                                <span>(${{ ($cartTotal * ($this->selectedPaymentMethod->fee/100)) }})</span>
                                                            </dd>
                                                        @elseif($selectedPaymentMethod->fee_type == \App\Models\PaymentMethod::FEE_TYPE_FIXED_AMOUNT)
                                                            <dd class="col-sm-6 text-sm-end mb-0">
                                                                ${{ $selectedPaymentMethod->fee }}
                                                            </dd>
                                                        @endif
                                                    </dl>
                                                @endif

                                                @if($promoCodeData)
                                                    <dl class="row">
                                                        <dt class="col-sm-6">{{ __('website.checkout.promo_code') }}
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
                                            </div>
                                        </div>

                                        <div class="d-grid gap-3 mb-4">

                                            <dl class="row">
                                                <dt class="col-sm-6">{{ __('website.checkout.total') }}</dt>
                                                <dd class="col-sm-6 text-sm-end mb-0">
                                                    ${{ number_format($totalPay, 2) }}</dd>
                                            </dl>
                                            <!-- End Row -->
                                        </div>

                                        <div class="d-grid">

                                            <button wire:click="placeOrder" wire:loading.attr="disabled"
                                                    wire:target="placeOrder" type="button" class="btn btn-dark btn-lg">
                                                <span wire:loading wire:target="placeOrder">
                                                    <span class="spinner-grow spinner-grow-sm me-1" role="status"
                                                          aria-hidden="true"></span>
                                                    <span class="visually-hidden">Loading...</span>
                                                    {{ __('website.checkout.place_order') }}
                                                </span>
                                                <span wire:loading.remove wire:target="placeOrder">
                                                    {{ __('website.checkout.placing_order') }}
                                                </span>
                                            </button>
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
                <div class="row">
                    <div class="col text-center">

                        <div class="w-50 mx-md-auto">

                            <i class="bi bi-check2-circle display-1 text-dark"></i>

                            <div class="mb-5">
                                <h1 class="h2">{{ __('website.checkout.order_completed_title') }}</h1>
                                <p>
                                    {{ __('website.checkout.order_completed_description') }}
                                </p>
                            </div>
                            <a class="btn btn-dark btn-transition rounded-pill px-6"
                               href="{{ route('store.products.index') }}">
                                {{ __('website.cart.continue_shopping') }}
                            </a>

                            <div class="mt-4"></div>

                            <span class="text-muted fw-bold">
                                   {{__('website.checkout.order')}} #{{ $order->number }}
                            </span>

                            <a class="link text-muted d-block"
                               href="{{ route('users.store.orders.invoice', $order->id) }}">
                                <i class="bi-chevron-left small ms-1"></i>
                                {{ __('website.checkout.view_invoice') }}
                            </a>
                            <a class="link text-muted d-block" href="{{ route('users.store.orders.index') }}">
                                <i class="bi-chevron-left small ms-1"></i>
                                {{ __('website.checkout.navigate_to_my_orders') }}
                            </a>
                            <a class="link text-muted d-block" href="{{ route('home') }}">
                                <i class="bi-chevron-left small ms-1"></i>
                                {{ __('website.checkout.back_to_home') }}
                            </a>

                        </div>


                    </div>
                </div>
            </div>
        @endif
    @else

        <div class="container content-space-2">

            <div class="row">
                <div class="col">
                    <div class="alert alert-soft-dark text-center py-5">
                        <div class="d-flex align-items-center justify-content-center h-100 flex-column">
                            <div>
                                <i class="bi-cart fs-3"></i>
                            </div>
                            <div>Please <a href="{{ route('login') }}">login</a> to your account to access checkout
                                screen.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endif


</div>
