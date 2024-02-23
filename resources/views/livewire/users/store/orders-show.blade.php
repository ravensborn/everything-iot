<div>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                @livewire('users.account.components.navbar-component', ['active' => 'orders'])
                <!-- End Navbar -->
            </div>
            <!-- End Col -->

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h4 class="card-header-title">{{ __('website.user_section.order') }} #{{ $order->number  }}</h4>
                            <div>
                                <a href="{{ route('users.store.orders.invoice', $order->id) }}" target="_blank" class="text-dark">
                                    <i class="bi bi-receipt"></i>
                                    {{ __('website.user_section.print_invoice') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5>{{ __('website.user_section.order_details') }}</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.status') }}:</span>
                                    <div class="d-inline badge bg-secondary">
                                        {{ $order->getStatusName() }}
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.payment') }}:</span>
                                    {{ $order->paymentMethod->name}}
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.total') }}:</span>
                                    ${{ number_format($order->total, 2)}}
                                </li>
                            </ul>

                            <div class="mt-5"></div>

                            <h5>{{ __('website.user_section.shipping_and_billing_address') }}</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.name') }}:</span>
                                    {{ $order->shipping_address['first_name'] }}
                                    {{ $order->shipping_address['last_name'] }}
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.email') }}:</span>
                                    {{ $order->shipping_address['email'] }}
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.phone_numbers') }}:</span>
                                    {{ $order->shipping_address['primary_phone_number'] }} -
                                    {{ $order->shipping_address['secondary_phone_number'] }}
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">{{ __('website.user_section.address') }}:</span>
                                    {{ $order->country->iso_alpha_3 }},
                                    {{ $order->shipping_address['address'] }}
                                </li>
                            </ul>

                            @if($order->note)
                                <div class="mt-5"></div>
                                <h5>{{ __('website.user_section.note') }}</h5>
                                <p>
                                    {{ $order->note }}
                                </p>
                            @endif

                            <div class="mt-5"></div>

                            <h5>{{ __('website.user_section.items') }}</h5>
                            <ul class="list-group">
                                @foreach($order->orderItems as $item)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-start align-items-center">

                                                <a href="{{ route('store.products.show', $item->product->slug) }}">
                                                    <img src="{{ $item->product->getCover() }}"
                                                         style="width: 64px;" alt="Item image"
                                                         class="img-thumbnail">
                                                </a>
                                                &nbsp;
                                                <div class="fw-bold text-truncate" style="width: 250px">
                                                    <a class="text-dark"
                                                       href="{{ route('store.products.show', $item->product->slug) }}">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="">
                                                    {{ $item->quantity }} X
                                                    ${{ number_format($item->price, 2) }}
                                                </div>
                                                <div class="fw-bold">
                                                    ${{ number_format($item->price *  $item->quantity, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <!-- End Card -->

                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Content -->

</div>
