<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lwwcas\LaravelCountries\Models\Country;

/**
 * App\Models\EnabledCountry
 *
 * @property int $id
 * @property int $lc_country_id
 * @property float $exchange_rate
 * @property float $delivery_fee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMethod> $paymentMethods
 * @property-read int|null $payment_methods_count
 * @method static \Database\Factories\EnabledCountryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereLcCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnabledCountry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnabledCountry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    CONST COUNTRY_IRAQ = 105;

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'lc_country_id');
    }

    public function paymentMethods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'enabled_country_payment_methods')
            ->withTimestamps();
    }

}
