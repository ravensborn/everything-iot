<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TimeNet Invoice #{{ $order->number }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/front/assets/css/snippets.min.css') }}">

</head>
<body>
<div class="container content-space-2">
    <div class="w-lg-85 mx-lg-auto">
        <!-- Card -->
        <div class="card card-lg mb-5">
            <div class="card-body">
                <div class="row justify-content-lg-between">
                    <div class="col-sm order-2 order-sm-1 mb-3">
                        <div class="mb-2">
                            <img class="img-fluid" style="width: 200px; height: auto;"
                                 src="{{ asset('images/logo-dark.png') }}" alt="Logo">
                        </div>

                        {{--                        <h1 class="h2 text-primary">TimeNet Company</h1>--}}
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto order-1 order-sm-2 text-sm-end mb-3">
                        <div class="mb-3">
                            <h2>Invoice #{{ $order->number }}</h2>
                            <span class="d-block">{{ $order->number }}</span>
                        </div>

                        <address class="text-dark">
                            44001<br>
                            Ankawa<br>
                            Kurdistan Region<br>
                            Iraq
                        </address>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

                <div class="row justify-content-md-between mb-3">
                    <div class="col-md">
                        <h4>Bill to:</h4>
                        <h4> {{ ucwords($order->user->name) }}</h4>

                        <address>
                            {{ $order->billing_address['address'] }},<br>
                            {{ $order->billing_address['country'] }}<br>

                        </address>
                    </div>
                    <!-- End Col -->

                    <div class="col-md text-md-end">
                        <dl class="row">
                            <dt class="col-sm-8">Invoice date:</dt>
                            <dd class="col-sm-4">{{ $order->created_at->format('d/m/Y') }}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-8">Due date:</dt>
                            <dd class="col-sm-4">Not specified</dd>
                        </dl>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-align-middle">
                        <thead class="thead-light">
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th class="table-text-end">Amount</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <th class="text-truncate">{{ $item->name }}</th>
                                <td>{{ $item->quantity }}</td>
                                <td class="table-text-end">$ {{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <hr class="my-5">

                <div class="row justify-content-md-end mb-3">
                    <div class="col-md-8 col-lg-7">
                        <dl class="row text-sm-end">
                            <dt class="col-sm-6">Subtotal:</dt>
                            <dd class="col-sm-6">${{ number_format($order->total, 2) }}</dd>
                            <dt class="col-sm-6">Total:</dt>
                            <dd class="col-sm-6">${{ number_format($order->total, 2) }}</dd>
                            <dt class="col-sm-6">Amount paid:</dt>
                            <dd class="col-sm-6">${{ number_format($order->total, 2) }}</dd>
                        </dl>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Row -->

                <div class="mb-3 d-print-none">
                    <h3>Thank you!</h3>
                    <p>If you have any questions concerning this invoice, use the following contact information:</p>
                </div>

                <p class="small mb-0 d-print-none">© {{ Date('Y') }} TimeNet.</p>
            </div>
        </div>
        <!-- End Card -->

        <!-- Footer -->
        <div class="d-flex justify-content-end d-print-none gap-3">
{{--            <a class="btn btn-white" href="#">--}}
{{--                <i class="bi-file-earmark-arrow-down me-1"></i> PDF--}}
{{--            </a>--}}

            <a class="btn btn-primary" href="javascript:;" onclick="window.print(); return false;">
                <i class="bi-printer me-1"></i> Print details
            </a>
        </div>
        <!-- End Footer -->
    </div>
</div>
</body>
</html>
