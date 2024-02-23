<?php

namespace App\Http\Livewire\Dashboard\ManageWebsiteTheme;

use App\Models\WebsiteTheme;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Index extends Component
{
    use LivewireAlert, WithFileUploads;

    public $currentTheme;

    public $websiteBannerPhoto;
    public $websiteBannerBgOverlay;
    public $websiteBannerBgPosition;
    public $storeBannerPhoto;
    public $storeBannerBgOverlay;
    public $storeBannerBgPosition;

    public function mount(): void
    {
        $this->loadCurrentTheme();
        $this->loadCoverSettings();
        $this->loadArticleSideImages();
    }

    public function loadCoverSettings(): void
    {
        if ($this->currentTheme->hasMedia('website-banner')) {

            $media = $this->currentTheme->getFirstMedia('website-banner');

            if ($media->hasCustomProperty('background-overlay')) {
                $this->websiteBannerBgOverlay = $media->getCustomProperty('background-overlay');
            }

            if ($media->getCustomProperty('background-overlay')) {
                $this->websiteBannerBgPosition = $media->getCustomProperty('background-position');
            }
        }

        if ($this->currentTheme->hasMedia('store-banner')) {

            $media = $this->currentTheme->getFirstMedia('store-banner');

            if ($media->hasCustomProperty('background-overlay')) {
                $this->storeBannerBgOverlay = $media->getCustomProperty('background-overlay');
            }

            if ($media->getCustomProperty('background-overlay')) {
                $this->storeBannerBgPosition = $media->getCustomProperty('background-position');
            }
        }
    }

    public function loadCurrentTheme(): void
    {
        $this->currentTheme = WebsiteTheme::where('is_selected', true)->first();
    }

    public function updateBanners(): void
    {
        $rules = [
            'websiteBannerPhoto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'websiteBannerBgOverlay' => 'required|string',
            'websiteBannerBgPosition' => 'required|string',

            'storeBannerPhoto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'storeBannerBgOverlay' => 'required|string',
            'storeBannerBgPosition' => 'required|string',
        ];

        $validated = $this->validate($rules);

        if ($this->websiteBannerPhoto) {
            $name = time() . '_' . Str::random(5);
            $this->currentTheme->clearMediaCollection('website-banner');
            $this->currentTheme->addMedia($this->websiteBannerPhoto)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->websiteBannerPhoto->getClientOriginalExtension())
                ->toMediaCollection('website-banner');
            $this->websiteBannerPhoto = null;
        }

        if ($this->storeBannerPhoto) {
            $name = time() . '_' . Str::random(5);
            $this->currentTheme->clearMediaCollection('store-banner');
            $this->currentTheme->addMedia($this->storeBannerPhoto)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->storeBannerPhoto->getClientOriginalExtension())
                ->toMediaCollection('store-banner');
            $this->storeBannerPhoto = null;
        }

        $websiteBannerMedia = $this->currentTheme->getFirstMedia('website-banner');

        if ($websiteBannerMedia) {
            $websiteBannerMedia->setCustomProperty('background-overlay', $validated['websiteBannerBgOverlay']);
            $websiteBannerMedia->setCustomProperty('background-position', $validated['websiteBannerBgPosition']);
            $websiteBannerMedia->save();
        }

        $this->alert('success', 'Successfully saved new settings.');
    }

    public function restoreDefaultCovers(): void
    {

        $this->currentTheme->clearMediaCollection('website-banner');
        $this->currentTheme->clearMediaCollection('store-banner');

        $this->currentTheme->addMedia(public_path('images/wallpapers/RUT200-social-alt-share.png'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 70%',
            ])
            ->toMediaCollection('website-banner');

        $this->currentTheme->addMedia(public_path('images/wallpapers/store-wallpaper.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'background-overlay' => 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))',
                'background-position' => 'center 50%',
            ])
            ->toMediaCollection('store-banner');

        $this->loadCurrentTheme();
        $this->loadCoverSettings();
        $this->alert('success', 'Successfully restored default settings.');

    }

    public $articleSideImages;
    public $articleSideImage;

    public function updatedArticleSideImage(): void
    {

        $rules = [
            'articleSideImage' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];

        $this->validate($rules);

        $image = $this->articleSideImage;

        $name = time() . '_' . Str::random(5);
        $this->currentTheme->addMedia($image)
            ->usingName($name)
            ->usingFileName($name . '.' . $image->getClientOriginalExtension())
            ->toMediaCollection('article_side_images');


        $this->articleSideImage = null;
        $this->loadCurrentTheme();
        $this->loadArticleSideImages();
    }

    public function loadArticleSideImages(): void
    {

        $this->articleSideImages = $this->currentTheme->getMedia('article_side_images');
    }

    public function deleteArticleSideImage($uuid): void
    {

        $image = $this->currentTheme->getMedia('article_side_images')
            ->where('uuid', $uuid)
            ->first();

        if ($uuid) {
            $image->delete();
        }

        $this->alert('success', 'Successfully deleted image.');

        $this->loadCurrentTheme();
        $this->loadArticleSideImages();
    }

    public function render()
    {
        return view('livewire.dashboard.manage-website-theme.index');
    }
}
