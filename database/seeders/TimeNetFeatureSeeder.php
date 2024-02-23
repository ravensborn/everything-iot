<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetFeatureSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $services = [
            [
                'title' => 'Feature A',
                'cover_url' => public_path('images/icons/isp.png'),
            ],
            [
                'title' => 'Feature B',
                'cover_url' => public_path('images/icons/customer-support.png'),
            ],
            [
                'title' => 'Feature C',
                'cover_url' => public_path('images/icons/encrypted.png'),
            ],
            [
                'title' => 'Feature D',
                'cover_url' => public_path('images/icons/clock.png'),
            ],
            [
                'title' => 'Feature E',
                'cover_url' => public_path('images/icons/vehicle.png'),
            ],
            [
                'title' => 'Feature F',
                'cover_url' => public_path('images/icons/research.png'),
            ]
        ];

        foreach ($services as $post) {

            $saved_post = \App\Models\Post::factory()->create(
                [
                    'author_id' => 1,
                    'category_id' => 5,
                    'title' => $post['title'],
                ]
            );

            $saved_post->addMedia($post['cover_url'])
                ->preservingOriginal()
                ->toMediaCollection('cover');
        }

    }
}
