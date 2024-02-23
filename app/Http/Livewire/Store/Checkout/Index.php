<?php

namespace App\Http\Livewire\Store\Checkout;

use App\Models\CartItem;
use App\Models\EnabledCountry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PromoCodeUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Lwwcas\LaravelCountries\Models\Country;


class Index extends Component
{

    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal = 0;
    public float $totalPay = 0;
    public $user = null;

    public float $shippingRate = 0;

    public string $checkoutFirstName = '';
    public string $checkoutLastName = '';
    public string $checkoutEmail = '';
    public string $checkoutPrimaryPhoneNumber = '';
    public string $checkoutSecondaryPhoneNumber = '';
    public string $checkoutAddress = '';
//    public int $checkoutCountry = 105;

    public Collection $paymentMethods;
    public Collection $enabledCountries;

    public PaymentMethod $selectedPaymentMethod;

    public bool $success = false;
    public Order $order;

    public bool $promoCodeCalculationEnabled = false;
    public string $promoCode = '';
    public $promoCodeData = null;

    public function placeOrder()
    {

        if ($this->isCartEmpty()) {
            $this->alert('error', 'An error while creating order, please contact support.');
            return false;
        }

        if (!$this->checkStockAvailability()) {

            $this->alert('error', 'One or more items is out of stock, please check your cart again.');

            return false;
        }

        sleep(3);

        if ($this->user) {

            $validated = $this->validate([
                'checkoutFirstName' => 'required|min:2|max:15',
                'checkoutLastName' => 'required|min:2|max:15',
                'checkoutEmail' => 'required|email',
                'checkoutPrimaryPhoneNumber' => 'required',
                'checkoutSecondaryPhoneNumber' => 'nullable',
                'checkoutAddress' => 'required|max:1000',
            ]);

            $shippingAddress = [
                'first_name' => $validated['checkoutFirstName'],
                'last_name' => $validated['checkoutLastName'],
                'email' => $validated['checkoutEmail'],
                'primary_phone_number' => $validated['checkoutPrimaryPhoneNumber'],
                'secondary_phone_number' => $validated['checkoutSecondaryPhoneNumber'],
                'address' => $validated['checkoutAddress'],
            ];

            $shippingRate = 0;
            $country = $this->user->country;
            $enabledCountry = EnabledCountry::where('lc_country_id', $country->id)->first();
            if ($enabledCountry) {
                $shippingRate = $enabledCountry->shipping_rate;
            }

            $number = $this->generateNumber();

            if($this->promoCodeData) {
                $this->promoCodeData->increment('uses');
                PromoCodeUser::create([
                    'promo_code_id' => $this->promoCodeData->id,
                    'user_id' => $this->user->id
                ]);
            }

            $order = new Order();
            $order = $order->create([
                'number' => $number,
                'name' => $number,
                'status' => Order::STATUS_PENDING,
                'lc_country_id' => $this->user->lc_country_id,
                'user_id' => $this->user->id,
                'payment_method_id' => $this->selectedPaymentMethod->id,
                'payment_method_fee_type' => $this->selectedPaymentMethod->fee_type,
                'payment_method_fee_amount' => $this->selectedPaymentMethod->fee,
                'shipping_address' => $shippingAddress,
                'billing_address' => $shippingAddress,
                'promo_code' => $this->promoCodeData ?  $this->promoCodeData->code : NULL,
                'promo_code_discount_type' => $this->promoCodeData ?  $this->promoCodeData->discount_type : NULL,
                'promo_code_discount_value' => $this->promoCodeData ?  $this->promoCodeData->discount_amount : 0,
                'total' => $this->totalPay,
                'shipping_rate' => $shippingRate,
            ]);

            foreach ($this->cartItems as $item) {

                $product = Product::find($item->product_id);
                $product->update([
                    'stock' => ($product->stock - $item->quantity)
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }

            $this->clearCartItems();
            $this->order = $order;
            $this->success = true;

            $this->emit('refresh-header-cart');
            $this->emit('scroll-to-top');

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

    public function calculatePromoCode(): void
    {
        if($this->promoCodeCalculationEnabled) {

            if($this->validatePromoCode($this->promoCode)) {
                $total = $this->calculatePromoCodeAmount($this->totalPay);
                $this->totalPay = $this->totalPay - $total;
            }

        }
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
    public function calculateTotal(): void
    {

        $this->getCartItems();

        $cart = $this->cartTotal;
        $shippingRate = $this->shippingRate;
        $paymentFee = 0;

        if ($this->selectedPaymentMethod->fee_type == PaymentMethod::FEE_TYPE_PERCENTAGE) {

            $paymentFee = $cart * ($this->selectedPaymentMethod->fee / 100);

        } elseif ($this->selectedPaymentMethod->fee_type == PaymentMethod::FEE_TYPE_FIXED_AMOUNT) {

            $paymentFee = $this->selectedPaymentMethod->fee;
        }

        $this->totalPay = ($cart + $shippingRate + $paymentFee);

    }

    public function selectPaymentMethod($value): void
    {

        sleep(1);

        $paymentMethod = PaymentMethod::find($value);

        $this->selectedPaymentMethod = $paymentMethod;
    }

    public function loadPaymentMethods(): void
    {


        $country = EnabledCountry::where('lc_country_id', $this->user->lc_country_id)->first();

        if ($country) {

            $this->paymentMethods = $country->paymentMethods;

        } else {
            $this->paymentMethods = collect();
        }

    }

    public function calculateShippingRate(): void
    {


        $country = EnabledCountry::where('lc_country_id', $this->user->lc_country_id)->first();

        if ($country) {

            $this->shippingRate = $country->shipping_rate;

        }
    }


    public function mount()
    {

        $promoCode = request()->input('promo_code', null);

        if($promoCode) {
            $this->promoCode = $promoCode;
            $this->promoCodeCalculationEnabled = true;
        }

        if (auth()->check()) {
            $this->user = auth()->user();
        } else {
            return redirect()->to('/');
        }


        $firstPaymentMethod = PaymentMethod::first();

        if ($firstPaymentMethod) {
            $this->selectedPaymentMethod = $firstPaymentMethod;
        }

        $this->enabledCountries = EnabledCountry::all();

        $this->calculateShippingRate();
        $this->loadPaymentMethods();
        $this->getCartItems();

        if ($this->cartItems->count() <= 0) {
            return redirect()->route('store.cartItems.index');
        }

    }

    public function clearCartItems(): void
    {

        CartItem::where('user_id', $this->user->id)->delete();

        $this->cartItems = collect();
        $this->cartTotal = 0;

    }

    public function isCartEmpty(): bool
    {
        return CartItem::where('user_id', $this->user->id)->count() == 0;
    }

    public function getCartItems(): void
    {
        $this->cartItems = CartItem::where('user_id', $this->user->id)->get();


        $cartTotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $this->cartTotal = $cartTotal;
    }

    public function render()
    {

        $this->calculateTotal();
        $this->calculatePromoCode();

        return view('livewire.store.checkout.index')->extends('layouts.store')->section('content');
    }

    private function getLatestOrder(): Model|Builder|null
    {
        return Order::orderBy('created_at', 'DESC')->first();
    }

    private function getLatestOrderId(): int
    {
        return $this->getLatestOrder() ? $this->getLatestOrder()->id : 0;
    }

    public function generateNumber(): string
    {

        $prefix = strtoupper(substr(config('env.APP_NAME'), 0, 1)) . '_';
        $last = $this->getLatestOrderId();
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }

}
