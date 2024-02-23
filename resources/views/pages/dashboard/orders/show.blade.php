@extends('layouts.dashboard')

@section('content')

    <h1 class="h3 mb-3">Manage Orders - {{ $order->number }}</h1>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Information</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                    <tr>
                                        <th class="text-start">Name</th>
                                        <td class="text-start">{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Number</th>
                                        <td class="text-start">{{ $order->number }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Status</th>
                                        <td class="text-start">{{ $order->getStatusName() }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">User</th>
                                        <td class="text-start">
                                            <a href="{{ route('dashboard.users.show', $order->user_id) }}">
                                                {{ $order->user->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Country</th>
                                        <td class="text-start">{{ $order->country->iso_alpha_3  }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">First Name</th>
                                        <td class="text-start">{{ $order->shipping_address['first_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Last Name</th>
                                        <td class="text-start">{{  $order->shipping_address['last_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Primary Phone Number</th>
                                        <td class="text-start">{{  $order->shipping_address['primary_phone_number'] }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Secondary Phone Number</th>
                                        <td class="text-start">{{  $order->shipping_address['secondary_phone_number'] }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Order Note</th>
                                        <td class="text-start text-wrap">
                                        <span>
                                            {{  $order->note }}
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Invoice</th>
                                        <td class="text-start">
                                            <a target="_blank" href="{{  route('users.store.orders.invoice', $order->id) }}">Print
                                                invoice</a>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Details</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">

                            <table class="table table-sm">
                                <tbody>

                                <tr>
                                    <th class="text-start">Shipping Rate</th>
                                    <td class="text-start">${{ $order->shipping_rate }}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th class="text-start">--}}
{{--                                        Exchange Rate--}}
{{--                                    </th>--}}
{{--                                    <td class="text-start">${{ $order->exchange_rate }}</td>--}}
{{--                                </tr>--}}

                                <tr>
                                    <th class="text-start">Payment Method</th>
                                    <td class="text-start">{{ $order->paymentMethod->name }}</td>
                                </tr>

                                <tr>
                                    <th class="text-start">Payment Method Fee Type</th>
                                    <td class="text-start">{{ $order->payment_method_fee_type }}</td>
                                </tr>

                                <tr>
                                    <th class="text-start">Payment Method Fee Amount</th>
                                    @if($order->payment_method_fee_type == \App\Models\PaymentMethod::FEE_TYPE_PERCENTAGE)
                                        <td class="text-start">%{{ $order->payment_method_fee_amount }}</td>
                                    @endif
                                    @if($order->payment_method_fee_type == \App\Models\PaymentMethod::FEE_TYPE_FIXED_AMOUNT)
                                        <td class="text-start">${{ $order->payment_method_fee_amount }}</td>
                                    @endif
                                </tr>

{{--                                <tr>--}}
{{--                                    <th class="text-start">Special Discount Type</th>--}}
{{--                                    @if($order->discount_type)--}}
{{--                                        <td class="text-start">{{ $order->discount_type }}</td>--}}
{{--                                    @else--}}
{{--                                        <td class="text-start">{{ 'No discount type' }}</td>--}}
{{--                                    @endif--}}
{{--                                </tr>--}}

{{--                                <tr>--}}
{{--                                    <th class="text-start">Special Discount Rate</th>--}}
{{--                                    @if($order->discount_type == NULL )--}}
{{--                                        <td class="text-start">{{ 'No discount rate' }}</td>--}}
{{--                                    @endif--}}
{{--                                    @if($order->discount_type == \App\Models\Order::DISCOUNT_TYPE_PERCENTAGE )--}}
{{--                                        <td class="text-start">%{{ $order->discount_amount }}</td>--}}
{{--                                    @endif--}}
{{--                                    @if($order->discount_type == \App\Models\Order::DISCOUNT_TYPE_FIXED_RATE )--}}
{{--                                        <td class="text-start">${{ $order->discount_amount }}</td>--}}
{{--                                    @endif--}}
{{--                                </tr>--}}

                                <tr>
                                    <th class="text-start">Used Promo Code</th>
                                    @if($order->promo_code)
                                        <td class="text-start">{{ $order->promo_code }}</td>
                                    @else
                                        <td class="text-start">{{ 'No promo code' }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="text-start">Promo Code Discount Type</th>
                                    @if($order->promo_code)
                                        <td class="text-start">{{ $order->promo_code_discount_type }}</td>
                                    @else
                                        <td class="text-start">{{ 'No promo code' }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="text-start">Promo Code Discount Amount</th>
                                    @if($order->promo_code)
                                        <td class="text-start">${{ $order->promo_code_discount_value }}</td>
                                    @else
                                        <td class="text-start">{{ 'No promo code' }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="text-start">Total</th>
                                    <th class="text-start">${{ $order->total }}</th>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Items</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 20px;">Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderItems as $item)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-wrap" style="width: 200px;">
                                                <a class="text-wrap text-truncate"
                                                   href="{{ route('store.products.show', $item->product->slug) }}">
                                                    {{ $item->product->name }}
                                                </a>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>$ {{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Status</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">

                            @livewire('dashboard.orders.status-updater', ['order' => $order->id])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
