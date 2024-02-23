<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FaqItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetFakeFAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Category::factory(3)->create([
            'model' => FaqItem::class,
        ]);

        FaqItem::factory(25)->create();


    }
}
