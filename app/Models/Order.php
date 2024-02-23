<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lwwcas\LaravelCountries\Models\Country;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array'
    ];

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_PROCESSING = 3;
    const STATUS_DELIVERING = 4;
    const STATUS_COMPLETED = 5;
    const STATUS_CANCELLED = 6;


    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    const DISCOUNT_TYPE_FIXED_RATE = 'fixed_rate';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
    }

    public function getStatusColorAndIcon(): array|string
    {

        $result = ['color' => 'warning', 'icon' => 'hourglass'];

        switch ($this->status) {
            case self::STATUS_PENDING :
                $result = ['color' => 'warning', 'icon' => 'hourglass'];
                break;
            case self::STATUS_APPROVED :
                $result = ['color' => 'success', 'icon' => 'hourglass-top'];
                break;
            case self::STATUS_PROCESSING :
                $result = ['color' => 'success', 'icon' => 'hourglass-split'];
                break;
            case self::STATUS_DELIVERING :
                $result = ['color' => 'success', 'icon' => 'truck'];
                break;
            case self::STATUS_COMPLETED :
                $result = ['color' => 'info', 'icon' => 'check2-all'];
                break;
            case self::STATUS_CANCELLED :
                $result = ['color' => 'danger', 'icon' => 'x-circle'];
                break;
        }

        return $result;
    }

    public function getStatusName(): string
    {
        return self::processStatusName($this->status);
    }

    public static function processStatusName($status): string
    {
        $result = 'Pending';

        switch ($status) {
            case self::STATUS_PENDING :
                $result = 'Pending';
                break;
            case self::STATUS_APPROVED :
                $result = 'Approved';
                break;
            case self::STATUS_PROCESSING :
                $result = 'Processing';
                break;
            case self::STATUS_DELIVERING :
                $result = 'Delivering';
                break;
            case self::STATUS_COMPLETED :
                $result = 'Completed';
                break;
            case self::STATUS_CANCELLED :
                $result = 'Cancelled';
                break;
        }

        return $result;
    }

    public static function getStatusAsArray(): array
    {
        return [self::STATUS_PENDING, self::STATUS_APPROVED, self::STATUS_PROCESSING, self::STATUS_DELIVERING, self::STATUS_COMPLETED, self::STATUS_CANCELLED];
    }


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'lc_country_id');
    }

    public function enabledCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EnabledCountry::class, 'lc_country_id');
    }

    public function getShippingRate()
    {
        $enabledCountry = $this->enabledCountry;

        if ($enabledCountry) {
            return $enabledCountry->delivery_fee;
        }

        return 0;

    }
}
