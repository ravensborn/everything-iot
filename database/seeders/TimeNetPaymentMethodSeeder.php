<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class TimeNetPaymentMethodSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $payments = [
            [
                'name' => 'Cash on Delivery',
                'fee' => 10,
                'fee_type' => 'fixed_amount',
                'enabled' => true,
                'icon_path' => public_path('seeder/payment-methods/cash-on-delivery.png'),
            ], [
                'name' => 'FastPay',
                'fee' => 5,
                'fee_type' => 'fixed_amount',
                'enabled' => false,
                'icon_path' => public_path('seeder/payment-methods/fastpay.png'),
            ],
            [
                'name' => 'NassWallet',
                'fee' => 5,
                'fee_type' => 'fixed_amount',
                'enabled' => false,
                'icon_path' => public_path('seeder/payment-methods/nasswallet.png'),
            ],

            [
                'name' => 'ZainCash',
                'fee' => 5,
                'fee_type' => 'fixed_amount',
                'enabled' => false,
                'icon_path' => public_path('seeder/payment-methods/zaincash.png'),
            ],
            [
                'name' => 'Stripe',
                'fee' => 5,
                'fee_type' => 'fixed_amount',
                'enabled' => false,
                'icon_path' => public_path('seeder/payment-methods/stripe.png'),
            ],
        ];

        foreach ($payments as $payment) {

            $createdPayment = PaymentMethod::factory([
                'name' => $payment['name'],
                'fee' => $payment['fee'],
                'fee_type' => $payment['fee_type'],
                'enabled' => $payment['enabled'],
            ])->create();


            $createdPayment->addMedia($payment['icon_path'])
                ->preservingOriginal()
                ->toMediaCollection('icon');
        }


    }
}
