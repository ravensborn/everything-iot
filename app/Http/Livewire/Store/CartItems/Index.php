<?php

namespace App\Http\Livewire\Store\CartItems;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Wishlist;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Index extends Component
{

    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal = 0;
    public float $totalPay = 0;
    public Authenticatable $user;

    public string $promoCode = '';
    public string $promoCodeStatus = 'not-checked';
    public $promoCodeData = null;

    public function updatedPromoCode(): void
    {
        $this->promoCodeProcess();
    }

    public function promoCodeProcess(): bool
    {
        if ($this->promoCode) {
            if ($this->validatePromoCode($this->promoCode)) {

                $this->promoCodeStatus = 'valid';

                $this->totalPay = $this->totalPay - $this->calculatePromoCodeAmount($this->cartTotal);

                return true;
            } else {
                $this->promoCodeStatus = 'invalid';
                return false;
            }
        }

        return false;
    }

    public function validatePromoCode($code): bool
    {
        $this->promoCodeData = null;
        $promoCode = PromoCode::where('code', $code)->first();

        if ($promoCode) {

            $validateMaxUsed = $promoCode->uses < $promoCode->max_uses;
            $validateUsageByCurrentUser = !$this->user->usedPromoCodes()->find($promoCode->id);

            if ($validateMaxUsed && $validateUsageByCurrentUser) {

                $this->promoCodeData = $promoCode;

                return true;
            }

        }

        return false;
    }

    public function calculatePromoCodeAmount($total): int
    {
        if ($this->promoCodeData) {

            if ($this->promoCodeData->discount_type == PromoCode::DISCOUNT_TYPE_FIXED && $total > 0) {

                $discountAmount = $this->promoCodeData->discount_amount;

            } elseif ($this->promoCodeData->discount_type == PromoCode::DISCOUNT_TYPE_PERCENTAGE && $total > 0) {

                $discountAmount = ($this->promoCodeData->discount_amount / 100) * $total;

            } else {

                $discountAmount = 0;
            }

            $newTotal = $discountAmount;
            return max($newTotal, 0);

        }
    }

    public function checkout(): void
    {

        if (!$this->checkStockAvailability()) {

            $this->alert('error', 'One or more items is out of stock, please check your cart again.');

        } else {

            if ($this->promoCodeData) {
                redirect()->route('store.checkout.index', ['promo_code' => $this->promoCodeData->code]);
            } else {

                redirect()->route('store.checkout.index',);
            }
        }

    }

    public function checkStockAvailability(): bool
    {
        $this->getCartItems();

        $cartItems = $this->cartItems;

        foreach ($cartItems as $item) {
            if (!$item->checkStockAvailability()) {
                return false;
            }
        }

        return true;
    }

    public function updateQuantity($product_id, $mode = 'increment'): void
    {

        $cartItem = CartItem::where('user_id', $this->user->id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {

            if ($mode == 'increment') {

                $product = Product::find($product_id);

                if (!$product->checkIfPurchasable()) {
                    $this->alert('error', 'Cannot add item to cart, there is no available stock.');

                } else {
                    $cartItem->increment('quantity', 1);
                }

            }

            if ($mode == 'decrement') {

                if (($cartItem->quantity - 1) <= 0) {

                    $cartItem->delete();

                } else {

                    $cartItem->decrement('quantity', 1);
                }
            }

            if ($mode == 'delete') {
                $cartItem->delete();
            }

            $this->emit('refresh-header-cart');


        } else {

            $this->alert('error', 'An issue while updating cart.');
        }


    }

    public function toWishlist($product_id, $mode = 'add'): void
    {
        if (auth()->check()) {
            if ($mode == 'add') {
                $wishlist = new Wishlist;
                $wishlist->create([
                    'user_id' => $this->user->id,
                    'product_id' => $product_id
                ]);

                $this->alert('success', 'Successfully added to wishlist.');
            }


            if ($mode == 'remove') {

                $wishlist = $this->user->wishlist()->where('product_id', $product_id)->first();

                if ($wishlist) {
                    $wishlist->delete();
                }

                $this->alert('success', 'Successfully removed from wishlist.');
            }


        } else {
            $this->alert('info', 'You need to be logged in first.');
        }

    }

    public function mount(): void
    {

        if (auth()->check()) {
            $this->user = auth()->user();
        }

        $this->getCartItems();

    }

    public function getCartItems()
    {

        if (!auth()->check()) {
            return false;
        }

        $this->cartItems = CartItem::where('user_id', $this->user->id)->get();

        $cartTotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $this->cartTotal = $cartTotal;
        $this->totalPay = $cartTotal;
    }

    public function render()
    {

        $this->getCartItems();
        $this->promoCodeProcess();

        return view('livewire.store.cart-items.index')->extends('layouts.store')->section('content');
    }

}
