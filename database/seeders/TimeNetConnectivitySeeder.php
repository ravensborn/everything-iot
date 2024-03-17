<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Connectivity;
use Illuminate\Database\Seeder;

class TimeNetConnectivitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $brands = [
            'LoraWan',
            'WiFi',
            'Bluetooth',
            'Mudbus',
            'ZigBee'
        ];

        foreach ($brands as $item) {
            Connectivity::factory([
                'name' => $item,
            ])->create();
        }


    }
}
