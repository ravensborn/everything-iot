<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TimeNet Invoice #{{ $order->number }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: 25px auto auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .button-7 {
            background-color: #0095ff;
            border: 1px solid transparent;
            border-radius: 3px;
            box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.15385;
            margin: 0;
            outline: none;
            padding: 8px .8em;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            white-space: nowrap;
        }

        .button-7:hover,
        .button-7:focus {
            background-color: #07c;
        }

        .button-7:focus {
            box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
        }

        .button-7:active {
            background-color: #0064bd;
            box-shadow: none;
        }

        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ asset('images/logo-dark.png') }}" style="width: 100%; max-width: 200px"/>
                        </td>

                        <td>
                            Invoice #: {{ $order->number }}<br/>
                            Created: {{ $order->created_at->format('d/m/Y') }}<br/>
                            Due: Not specified
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            44001<br/>
                            Ankawa<br/>
                            Kurdistan Region<br/>
                            IRQ
                        </td>

                        <td>
                            {{ ucwords($order->user->name) }}<br/>
                            {{ $order->billing_address['address'] }},<br>
                            {{ $order->country->alpha_iso_3 }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>
            <td></td>
            <td></td>
        </tr>

        <tr class="details">
            <td>{{ $order->paymentMethod->name }}</td>
            <td></td>
            @if($order->payment_method_fee_amount == 0)
                <td>{{ 'Free Shipping' }}</td>
            @else
                @if($order->payment_method_fee_type == \App\Models\PaymentMethod::FEE_TYPE_FIXED_AMOUNT)
                    <td>${{ $order->payment_method_fee_amount }}</td>
                @endif
                @if($order->payment_method_fee_type == \App\Models\PaymentMethod::FEE_TYPE_PERCENTAGE)
                    <td>%{{ $order->payment_method_fee_amount }}</td>
                @endif
            @endif
        </tr>

        <tr class="heading">
            <td>Shipping Rate</td>
            <td></td>
            <td></td>
        </tr>

        <tr class="details">
            <td>TimeNet Shipping</td>
            <td></td>
            @if(!$order->shipping_rate)
                <td>{{ 'Free Shipping' }}</td>
            @else
                <td>${{ $order->shipping_rate }}</td>
            @endif
        </tr>

        @if($order->promo_code)
            <tr class="heading">
                <td>Promo Code</td>
                <td></td>
                <td></td>
            </tr>

            <tr class="details">
                <td>{{ $order->promo_code }}</td>
                <td></td>
                @if($order->promo_code_discount_type == \App\Models\PromoCode::DISCOUNT_TYPE_FIXED)
                    <td>${{ $order->payment_method_fee_amount }}</td>
                @endif
                @if($order->promo_code_discount_type == \App\Models\PromoCode::DISCOUNT_TYPE_PERCENTAGE)
                    <td>%{{ $order->payment_method_fee_amount }}</td>
                @endif
            </tr>
        @endif

        <tr class="heading">
            <td>Item</td>

            <td style="text-align: center">Quantity</td>
            <td style="text-align: center">Price</td>
        </tr>

        @foreach($order->orderItems as $item)
            <tr class="item @if($loop->last) last  @endif">
                <td>{{ $item->product->name }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: center;" class="table-text-end">${{ number_format($item->price, 2) }}</td>
            </tr>
        @endforeach

        <tr class="total">
            <td></td>
            <td colspan="2">Total: ${{ number_format($order->total, 2) }}</td>
        </tr>
    </table>
</div>

<div class="no-print" style="margin-left: auto; text-align: center; margin-top: 20px; margin-bottom: 100px;">
    <button style="width: 200px;" class="button-7" onclick="window.print();return false;">Print</button>
    <a style="width: 200px;" class="button-7" href="{{ route('users.store.orders.show', $order->id) }}">Back to
        order</a>
</div>

</body>
</html>
