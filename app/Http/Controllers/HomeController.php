<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Post;
use App\Models\WebsiteTheme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        visitor()->visit();

        $features = Post::where('category_id', 5)
            ->where('is_hidden', false)
            ->limit(6)->get();

        $articles = Post::where('category_id', 4)
            ->where('is_hidden', false)
            ->limit(3)->get();

        $partners = Partner::where('is_visible', true)->orderBy('order')->get();

        $websiteTheme = WebsiteTheme::where('is_selected', true)->first();

        $bannerArray = [
            'image' => '',
            'backgroundOverlay' => '',
            'backgroundPosition' => '',
        ];

        if ($websiteTheme) {

            $banner = $websiteTheme->getFirstMedia('website-banner');

            $bannerArray['image'] = $banner->getFullUrl();

            if ($banner->hasCustomProperty('background-overlay')) {
                $bannerArray['backgroundOverlay'] = $banner->getCustomProperty('background-overlay') . ',';
            }

            if ($banner->hasCustomProperty('background-position')) {
                $bannerArray['backgroundPosition'] = $banner->getCustomProperty('background-position');
            }
        }

        return view('home', [
            'features' => $features,
            'articles' => $articles,
            'partners' => $partners,
            'banner' => $bannerArray,
        ]);
    }
}
