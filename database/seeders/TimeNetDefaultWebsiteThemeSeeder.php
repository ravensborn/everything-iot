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
            'name' => 'Default TimeNet Theme',
            'description' => 'The default theme created for TimeNet website, consists of modern simple looking elements that gives TimeNet a modern look, that is easy to use.',
            'is_selected' => true,
            'properties' => [],
        ]);

        $defaultTheme->addMedia(public_path('images/wallpapers/RUT200-social-alt-share.png'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 70%',
            ])
            ->toMediaCollection('website-banner');

        $defaultTheme->addMedia(public_path('images/wallpapers/store-wallpaper.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 50%',
            ])
            ->toMediaCollection('store-banner');

    }
}
