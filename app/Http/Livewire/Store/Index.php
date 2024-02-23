<?php

namespace App\Http\Livewire\Store;

use App\Models\Partner;
use App\Models\WebsiteTheme;
use Illuminate\Support\Collection;
use Livewire\Component;


class Index extends Component
{

    public Collection $partners;
    public $bannerArray;

    public function mount(): void
    {
        $websiteTheme = WebsiteTheme::where('is_selected', true)->first();

        $this->bannerArray = [
            'image' => '',
            'backgroundOverlay' => '',
            'backgroundPosition' => '',
        ];

        if($websiteTheme) {

            $banner = $websiteTheme->getFirstMedia('store-banner');

            $bannerArray['image'] = $banner->getFullUrl();

            if($banner->hasCustomProperty('background-overlay')) {
                $bannerArray['backgroundOverlay'] = $banner->getCustomProperty('background-overlay') . ',';
            }

            if($banner->hasCustomProperty('background-position')) {
                $bannerArray['backgroundPosition'] = $banner->getCustomProperty('background-position');
            }

            $this->bannerArray = $bannerArray;

        }

        $this->partners = Partner::where('is_visible', true)->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.store.index')->extends('layouts.store')->section('content');
    }
}
