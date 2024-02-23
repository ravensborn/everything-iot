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
                            <li class="breadcrumb-item">
                                <a href="{{ route('store.products.index') }}">{{ __('website.breadcrumb.products') }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @if(strlen($product->name) > 15)
                                    {{ substr($product->name, 0, 15) . '...' }}
                                @else
                                    {{$product->name }}
                                @endif
                            </li>
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

    <!-- Hero -->
    <div class="container content-space-t-2 content-space-b-4">
        <div class="row">
            <div class="col-md-7 mb-7 mb-md-0">
                <div class="pe-md-4">
                    <div class="card-pinned" wire:ignore>
                        <!-- Swiper Main Slider -->
                        <div class="js-swiper-shop-product swiper">
                            <div class="swiper-wrapper">
                                @foreach($product->getMedia('images') as $image)
                                    <!-- Slide -->
                                    <div class="swiper-slide">
                                        <div class="card card-bordered shadow-none">
                                            <img class="card-img" src="{{ $image->getFullUrl() }}"
                                                 alt="Image Description">
                                        </div>
                                    </div>
                                    <!-- End Slide -->

                                @endforeach
                            </div>

                            <!-- Arrows -->
                            <div class="js-swiper-shop-product-button-next swiper-button-next"></div>
                            <div class="js-swiper-shop-product-button-prev swiper-button-prev"></div>
                        </div>
                        <!-- End Swiper Main Slider -->

                        <!-- Swiper Thumb Slider -->
                        <div class="position-absolute bottom-0 end-0 start-0 zi-1 p-4">
                            <div class="js-swiper-shop-product-thumb swiper" style="max-width: 15rem;">
                                <div class="swiper-wrapper">

                                    @foreach($product->getMedia('images') as $image)
                                        <!-- Slide -->
                                        <div class="swiper-slide">
                                            <a class="avatar avatar-circle" href="javascript:;">
                                                <img class="avatar-img" src="{{ $image->getFullUrl() }}"
                                                     alt="Image Description">
                                            </a>
                                        </div>
                                        <!-- End Slide -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- End Swiper Thumb Slider -->
                    </div>
                </div>
                <div class="mt-5 d-none d-md-block">

                    <div class="row">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="col-md-6">
                                <!-- Card -->
                                <div class="border-bottom h-100 py-5">
                                    <div class="row">

                                        <div class="col-6">
                                            <span class="text-cap">{{ ucfirst($relatedProduct->category->name) }}</span>
                                            <h4 class="mb-0">
                                                <a class="text-dark"
                                                   href="{{ route('store.products.show', $relatedProduct->slug) }}">
                                                    @if(strlen($relatedProduct->name) > 35)
                                                        {{ substr($relatedProduct->name, 0, 35) . '...' }}
                                                    @else
                                                        {{ $relatedProduct->name }}
                                                    @endif
                                                </a>
                                            </h4>
                                            <p>
                                                @if(strlen($relatedProduct->description) > 40)
                                                    {!!  substr($relatedProduct->description, 0, 40) . '...'  !!}
                                                @else
                                                    {!! $relatedProduct->description !!}
                                                @endif

                                            </p>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-5">
                                            <img class="img-fluid rounded" src="{{ $relatedProduct->getCover(asset('images/logo-dark.png')) }}"
                                                 alt="Related Product Cover">
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Card -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- End Col -->

            <div class="col-md-5">
                <!-- Rating -->
                <span class="text-dark d-flex gap-1 mb-4">
                    <img src="{{ asset('themes/front/assets/svg/illustrations/star.svg') }}" alt="Review rating"
                         width="16">
                    <img src="{{ asset('themes/front/assets/svg/illustrations/star.svg') }}" alt="Review rating"
                         width="16">
                    <img src="{{ asset('themes/front/assets/svg/illustrations/star.svg') }}" alt="Review rating"
                         width="16">
                    <img src="{{ asset('themes/front/assets/svg/illustrations/star.svg') }}" alt="Review rating"
                         width="16">
                    <img src="{{ asset('themes/front/assets/svg/illustrations/star.svg') }}" alt="Review rating"
                         width="16">
                    <span class="ms-1">{{ $product->visitLogs()->distinct('ip')->count('ip') }} {{ __('website.store.views') }}</span>
                </span>
                <!-- End Rating -->

                <!-- Heading -->
                <div class="mb-3">
                    <h1 class="h2">{{ $product->name }}</h1>
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
                <!-- End Heading -->

                <div class="mb-3">
                    @if(auth()->check())
                        <a class="link-sm link-secondary small"
                           style="cursor:pointer;"
                           wire:click="toWishlist()">
                            @if($productWishlisted)
                                <i class="bi-heart-fill text-danger me-1"></i>
                                <span class="text-danger">{{ __('website.store.save_for_later') }}</span>
                            @else
                                <i class="bi-heart me-1"></i>
                                {{ __('website.store.save_for_later') }}
                            @endif
                        </a>
                    @endif
                </div>

                <!-- Price -->
                <div class="mb-5">
                    <span class="d-block mb-2">{{ __('website.store.total_price') }}</span>
                    <div class="d-flex align-items-center">
                        @if($product->previous_price)
                            <h3 class="mb-0">${{ number_format($product->price, 2) }}</h3>
                            <span class="ms-2"><del>${{ number_format($product->previous_price, 2) }}</del></span>
                        @else
                            <h3 class="mb-0">${{ number_format($product->price, 2) }}</h3>
                        @endif
                    </div>
                </div>
                <!-- End Price -->

                <!-- Quantity -->
                <div class="quantity-counter mb-3">
                    <div class="js-quantity-counter row align-items-center">
                        <div class="col">
                            <span class="d-block small">{{ __('website.store.select_quantity') }}</span>
                            <input class="js-result form-control form-control-quantity-counter" type="text"
                                   wire:model="quantity">
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                            <a class="js-minus btn btn-outline-secondary btn-xs btn-icon rounded-circle"
                               wire:click="adjustQuantity('decrement')">
                                <svg width="8" height="2" viewBox="0 0 8 2" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 1C0 0.723858 0.223858 0.5 0.5 0.5H7.5C7.77614 0.5 8 0.723858 8 1C8 1.27614 7.77614 1.5 7.5 1.5H0.5C0.223858 1.5 0 1.27614 0 1Z"
                                        fill="currentColor"/>
                                </svg>
                            </a>
                            <a class="js-plus btn btn-outline-secondary btn-xs btn-icon rounded-circle"
                               wire:click="adjustQuantity('increment')">
                                <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 0C4.27614 0 4.5 0.223858 4.5 0.5V3.5H7.5C7.77614 3.5 8 3.72386 8 4C8 4.27614 7.77614 4.5 7.5 4.5H4.5V7.5C4.5 7.77614 4.27614 8 4 8C3.72386 8 3.5 7.77614 3.5 7.5V4.5H0.5C0.223858 4.5 0 4.27614 0 4C0 3.72386 0.223858 3.5 0.5 3.5H3.5V0.5C3.5 0.223858 3.72386 0 4 0Z"
                                        fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Quantity -->

                @if($product->getFeatures())

                    <!-- Accordion -->
                    <div class="accordion mb-5" id="shopCartAccordion">
                        @foreach($product->getFeatures() as $key => $feature)

                            <div class="p-2">
                               <span class="text-dark fw-bold">
                                   <div class="d-flex align-items-center">
                                       <div>
                                           <i class="bi bi-check-lg text-dark" style="font-size: 20px;"></i>
                                       </div>
                                       <div class="ms-2">
                                           {{ $feature['name'] }}
                                       </div>
                                   </div>
                               </span>
                            </div>

                        @endforeach
                    </div>
                    <!-- End Accordion -->

                @endif

                <div class="d-grid mb-2">
                    @if(auth()->check())

                        @if($product->is_purchasable_online)
                            @if($product->checkIfPurchasable())
                                <button type="button" class="btn btn-dark btn-transition rounded-pill"
                                        wire:click="addToCart()">
                                    <i class="bi bi-cart me-1"></i>
                                    {{ __('website.store.add_to_cart') }}
                                    @if($userCart)
                                        ({{ $userCart }})
                                    @endif
                                </button>
                            @else
                                <button type="button" class="btn btn-dark btn-transition rounded-pill"
                                        wire:click="addToCart()">
                                    <i class="bi bi-box me-1"></i>
                                    {{ __('website.store.available_soon') }}
                                </button>
                            @endif
                        @else
                            <a class="btn btn-dark btn-transition rounded-pill"
                               href="mailto:info@time-net.net">
                                <i class="bi bi-envelope me-1"></i>
                                {{ __('website.store.contact_us') }}
                            </a>
                        @endif

                    @else
                        <a href="{{ route('login') }}" class="btn btn-dark btn-transition rounded-pill"
                           wire:click="addToCart(0, 'add')">{{ __('website.store.login_or_register_to_add_to_cart') }}</a>

                    @endif
                </div>

                @if(auth()->check() && $userCart > 0)
                    <div class="d-grid mb-4">
                        <a href="{{ route('store.cartItems.index') }}"
                           class="btn btn-outline-dark btn-transition rounded-pill" wire:click="addToCart(0, 'add')">
                            {{ __('website.store.view_shopping_cart') }}
                        </a>

                    </div>
                @endif
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Hero -->
    </div>
