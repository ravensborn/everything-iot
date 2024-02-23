<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EnabledCountry;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class TimeNetCountrySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            \Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder::class, //Countries
        ]);

        $iraq = EnabledCountry::create([
            'lc_country_id' => 105, //Iraq
            'shipping_rate' => 10
        ]);

        $iraq->paymentMethods()->attach(PaymentMethod::ITEM_CASH_ON_DELIVERY);

        //Random payment methods.
        $iraq->paymentMethods()->attach(PaymentMethod::whereNot('id', PaymentMethod::ITEM_CASH_ON_DELIVERY)->get()->pluck('id'));


    }
}
