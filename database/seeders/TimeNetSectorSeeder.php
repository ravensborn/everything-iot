<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class TimeNetSectorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $brands = [
            'Agriculture',
            'Asset Tracking',
            'Healthcare',
            'Hospitality',
            'Industrial',
            'Smart Buildings',
            'Smart Cities',
            'Smart Metering'
        ];

        foreach ($brands as $item) {
            Sector::factory([
                'name' => $item,
            ])->create();
        }


    }
}
