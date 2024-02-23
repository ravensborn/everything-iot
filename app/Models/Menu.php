<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['properties' => 'array', 'items' => 'array'];
    const ITEM_TYPE_ROUTE = 'route';
    const ITEM_TYPE_LINK = 'link';
    const ITEM_TYPE_POST = 'post';
    const ITEM_TYPE_POST_DROPDOWN = 'post_dropdown';
    const ITEM_TYPE_ROUTE_DROPDOWN = 'route_dropdown';
    const ITEM_TYPE_LINK_DROPDOWN = 'link_dropdown';
    const ITEM_TYPE_USER_ACCOUNT = 'user_account_dropdown';
    const ITEM_TYPE_LANG_SWITCHER = 'language_switcher_dropdown';
    const ITEM_TYPE_CALL_US_BTN = 'call_us_button';
    const ITEM_TYPE_LIVEWIRE_CART = 'livewire_cart';

    public static function menuItemsArray(): array
    {
        return [
            self::ITEM_TYPE_ROUTE,
            self::ITEM_TYPE_LINK,
            self::ITEM_TYPE_POST,
            self::ITEM_TYPE_ROUTE_DROPDOWN,
            self::ITEM_TYPE_LINK_DROPDOWN,
            self::ITEM_TYPE_POST_DROPDOWN,
            self::ITEM_TYPE_USER_ACCOUNT,
            self::ITEM_TYPE_LANG_SWITCHER,
            self::ITEM_TYPE_CALL_US_BTN,
            self::ITEM_TYPE_LIVEWIRE_CART,
        ];
    }
}
