<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class TimeNetBrandSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $brands = [
            'Teknykar',
            'Seeed',
            'Netvox',
            'Teltonika',
            'Tektelic',
            'Milesight',
        ];

        foreach ($brands as $item) {
            Brand::factory([
                'name' => $item,
            ])->create();
        }


    }
}
