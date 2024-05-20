<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Connectivity;
use App\Models\Product;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class TimeNetProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $arrayOfCategories = [
            'Everything IOT',
            'Bluetooth',
            'WIFI',
            'Health Care',
            'Security',
            'Home Automation',
        ];

        foreach ($arrayOfCategories as $item) {
            \App\Models\Category::factory([
                'name' => $item,
                'model' => Product::class,
            ])->create();
        }

        for ($i = 1; $i <= 100; $i++) {

            $category = Category::where('model', Product::class)->inRandomOrder()->first();
            $brand = Brand::inRandomOrder()->first();
            $connectivity = Connectivity::inRandomOrder()->first();
            Product::factory()->create([
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'connectivity_id' => $connectivity->id,
                'name' => $brand->name . ' ' . $category->name . ' #' . rand(10000, 99999),
                'properties' => [
                    'features' => [
                        [
                            'name' => 'Example feature 1',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dignissimos eos eveniet facere, iste
                iure laboriosam minus, modi ne',
                        ],
                        [
                            'name' => 'Example feature 2',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dignissimos eos eveniet facere, iste
                iure laboriosam minus, modi ne',
                        ],
                        [
                            'name' => 'Example feature 3',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dignissimos eos eveniet facere, iste
                iure laboriosam minus, modi ne',
                        ]
                    ]
                ]
            ]);
        }


        $products = Product::whereIn('category_id', Category::where('model', Product::class)
            ->pluck('id'))->get();

        foreach ($products as $product) {

            $path = public_path('images/examples/900x660.jpg');

            $product->addMedia($path)
                ->preservingOriginal()
                ->toMediaCollection('cover');

            for ($i = 1; $i <= 3; $i++) {

                $path = public_path('images/wallpapers/' . $i . '.jpg');

                $product->addMedia($path)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }

        $sectors = Sector::all();
        $products = Product::all();
        foreach ($products as $product) {

            $randomSectors = $sectors->random(rand(1, $sectors->count()));

            $product->sectors()->sync($randomSectors->pluck('id')->toArray());
        }

    }
}
