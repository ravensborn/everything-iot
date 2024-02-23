<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Shetabit\Visitor\Traits\Visitable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $lc_country_id
 * @property int $category_id
 * @property int $brand_id
 * @property float $price
 * @property array|null $additional_fees
 * @property array|null $properties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand|null $brands
 * @property-read \App\Models\Category $category
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdditionalFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLcCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, HasSlug, Visitable;

    protected $casts = [
        'properties' => 'array',
        'additional_fees' => 'array',
        'is_hidden' => 'boolean',
        'is_promo_code_active' => 'boolean',
        'is_purchasable_online' => 'boolean',
    ];

    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brands(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getFeatures(): array
    {
        if ($this->properties == null) {
            return [];
        }

        if (array_key_exists('features', $this->properties)) {
            return $this->properties['features'];
        }
        return [];
    }

    public function getCover($replaceDefaultImageUrl = null): string
    {

        $media = $this->getMedia('images')
            ->where('uuid', $this->cover_image)
            ->first();
        if ($media) {

            return $media->getFullUrl();
        }

        if ($replaceDefaultImageUrl) {
            return $replaceDefaultImageUrl;
        }

        return 'https://dummyimage.com/1000x700/ccc/111';
    }


    public function calculateAvailableStock()
    {

        $stock = $this->stock;


        if (auth()->check()) {
            $productInCart = CartItem::where('user_id', auth()->user()->id)
                ->where('product_id', $this->id)
                ->first();
            if ($productInCart) {
                $stock = $stock - $productInCart->quantity;
            }
        }

        return $stock;
    }

    public function checkIfPurchasable($extraQuantity = 0): bool
    {
        return ($this->calculateAvailableStock() - $extraQuantity) > 0;
    }

}
