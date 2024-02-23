<?php

namespace Database\Factories;

use App\Models\EnabledCountry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $address = [
            'first_name' => 'Yad',
            'last_name' => 'Hoshyar',
            'email' => 'email@example.com',
            'primary_phone_number' => '+9647507534867',
            'secondary_phone_number' => '+964757534867',
            'address' => 'Rasty St, Erbil, 44001, KRI',
        ];

        return [
            'number' => 'T_' . fake()->randomNumber(5, true),
            'name' => $this->faker->sentence,
            'user_id' => 1,
            'status' => Order::STATUS_PENDING,
            'lc_country_id' => EnabledCountry::COUNTRY_IRAQ,
            'payment_method_id' => PaymentMethod::ITEM_CASH_ON_DELIVERY,
            'shipping_address' => $address,
            'billing_address' => $address,
            'discount_type' => NULL,
            'discount_amount' => 0,
            'shipping_rate' => 0,
            'exchange_rate' => 0,
            'promo_code' => NULL,
            'promo_code_discount_value' => 0,
            'total' => $this->faker->randomNumber(4, true),
            'note' => $this->faker->paragraph,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
           for($i = 1; $i <=3; $i++) {
               OrderItem::create([
                   'order_id' => $order->id,
                   'product_id' => $this->faker->randomElement(Product::limit(10)->pluck('id')),
                   'price' => $order->total / 3,
                   'quantity' => $this->faker->randomNumber(1, true),
               ]);
           }
        });
    }
}
