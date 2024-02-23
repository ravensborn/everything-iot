<?php

namespace App\Http\Livewire\Dashboard\Products;

use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;


class MediaManager extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;
    public $product;

    public $photos;
    public $productImages;

    public function updatedPhotos(): void
    {
        $this->validate([
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
        ]);

        foreach ($this->photos as $photo) {

            $name = time() . '_' . Str::random(5);

            $this->product->addMedia($photo)
                ->usingName($name)
                ->usingFileName($name . '.' . $photo->getClientOriginalExtension())
                ->toMediaCollection('images');

//            Image::load($photo)
//                ->fit(Manipulations::FIT_CONTAIN, 1000, 1000)
//                ->optimize()
//                ->save();


            $this->getProductImages();

        }


    }

    public function updateCover($uuid): void
    {
        $this->product->update([
            'cover_image' => $uuid
        ]);
        $this->alert('success', $uuid);
//        $this->alert('success', 'Successfully updated product cover.');
    }

    public function removeImage($uuid): void
    {
        $image = $this->product->getMedia('images')->where('uuid', $uuid)->first();
        if ($image) {
            $image->delete();
            $this->getProductImages();
        }

    }

    public function getProductImages(): void
    {
        $this->product = Product::find($this->product->id);
        $this->productImages = $this->product->getMedia('images');


    }

    public function mount(Product $product): void
    {

        $this->product = $product;
        $this->getProductImages();

    }

    public function render()
    {
        return view('livewire.dashboard.products.media-manager');
    }
}
