<?php

namespace App\Http\Livewire\Store\Products;

use App\Models\CartItem;
use App\Models\Post;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Show extends Component
{

    use LivewireAlert;

    public Product $product;
    public Collection $relatedProducts;

    public int $quantity = 1;

    public int $userCart = 0;
    public bool $productWishlisted = false;

    public function updatedQuantity()
    {
        if ($this->quantity > 50) {
            $this->quantity = 50;
        }
    }

    public function adjustQuantity($mode = 'increment'): void
    {

        if ($mode == 'increment') {
            if ($this->product->checkIfPurchasable($this->quantity)) {
                $this->quantity = $this->quantity + 1;
            }

        }
        if ($mode == 'decrement') {
            if ($this->quantity >= 2) {
                $this->quantity = $this->quantity - 1;
            }
        }
    }

    public function toWishlist(): void
    {

        if (auth()->check()) {

            $user = auth()->user();

            if ($this->getWishlistStatus($user)) {

                $existInWishList = $user->wishlist()->where('product_id', $this->product->id)->first();

                $existInWishList->delete();

                $this->alert('success', 'item removed from wishlist.');

            } else {

                $wishlist = new Wishlist;
                $wishlist->create([
                    'user_id' => $user->id,
                    'product_id' => $this->product->id
                ]);

                $this->productWishlisted = true;

                $this->alert('success', 'item added to wishlist.');

            }


            $this->getWishlistStatus($user);

        } else {
            $this->alert('info', 'You need to be logged in first.');
        }


    }

    public function addToCart()
    {

        $quantity = 1;

        if ($this->quantity > 0) {
            $quantity = $this->quantity;
        }

        if (auth()->check()) {

            $product = Product::findOrFail($this->product->id);

            if (!$product->checkIfPurchasable($this->quantity - 1)) {
                $this->alert('error', 'Cannot add item to cart, there is no available stock.');
                return false;
            }

            $existingInCart = CartItem::where('user_id', auth()->user()->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingInCart) {

                $existingInCart->increment('quantity', $this->quantity);

            } else {

                $cartItem = new CartItem;

                $cartItem->create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);

            }

            $this->emit('refresh-header-cart');
            $this->alert('success', 'Item added to cart.');
            $this->quantity = 1;
        }

        $this->getUserCart();

    }

    public function getUserCart(): void
    {
        $this->userCart = auth()->user()->cartItems->count();
    }

    public function getWishlistStatus($user): bool
    {
        $existInWishList = $user->wishlist()->where('product_id', $this->product->id)->first();

        if ($existInWishList) {
            $this->productWishlisted = true;
            return true;
        }

        $this->productWishlisted = false;
        return false;
    }

    public function mount($slug): void
    {
        $user = auth()->user();

        if (auth()->check() && $user->hasRole('admin')) {

            $product = Product::where('slug', $slug)
                ->firstOrFail();
        } else {
            $product = Product::where('slug', $slug)
                ->where('is_hidden', false)
                ->firstOrFail();
        }

        $this->getRelatedProducts($product, $slug);

        $this->product = $product;

        if ($user) {
            $this->getWishlistStatus($user);
            $this->getUserCart();
        }

        visitor()->visit($product);
    }

    public function getRelatedProducts($product, $slug): void
    {
        $this->relatedProducts = Product::where('category_id', $product->category_id)
            ->where('slug', '!=', $slug)
            ->limit(4)
            ->inRandomOrder()
            ->get();
//            ->map(function ($item) {
//
////                $coverImage = Media::where('model_type', Product::class)
////                    ->where('model_id', $item->id)
////                    ->where('uuid', $item->cover_image)
////                    ->first();
////
////                if ($coverImage) {
////                    $item['image'] = $coverImage->getFullUrl();
////                } else {
////                    $item['image'] = asset('images/logo-dark.png');
////                }
//
//                $item['image'] = Product::find($item->id)->getCover(asset('images/logo-dark.png'));
//
//                return $item;
//            });
    }

    public function render()
    {


        return view('livewire.store.products.show')->extends('layouts.store')->section('content');
    }
}
