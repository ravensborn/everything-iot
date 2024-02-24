<?php

namespace Database\Seeders;

use App\Models\WebsiteTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetDefaultWebsiteThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $defaultTheme = WebsiteTheme::create([
            'name' => 'Default EverythingIOT Theme',
            'description' => 'The default theme created for EverythingIOT website, consists of modern simple looking elements that gives EverythingIOT a modern look, that is easy to use.',
            'is_selected' => true,
            'properties' => [],
        ]);

        $defaultTheme->addMedia(public_path('images/wallpapers/1.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 70%',
            ])
            ->toMediaCollection('website-banner');

        $defaultTheme->addMedia(public_path('images/wallpapers/1.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 50%',
            ])
            ->toMediaCollection('store-banner');

    }
}
