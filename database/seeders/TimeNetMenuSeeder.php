<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeNetMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homepageMenu = Menu::create([
            'name' => 'Homepage Menu',
            'code' => 'homepage_menu',
            'items' => [
                [
                    'name' => 'Time Net',
                    'type' => Menu::ITEM_TYPE_ROUTE_DROPDOWN,
                    'array' => [
                        [
                            'name' => 'Product Catalog',
                            'url' => route('posts.index', ['grid_type' => 'grid', 'slug' => 'product-catalog']),
                        ],
                        [
                            'name' => 'Services',
                            'url' => route('posts.index', ['grid_type' => 'grid', 'slug' => 'services']),
                        ],
                        [
                            'name' => 'Solutions',
                            'url' => route('posts.index', ['grid_type' => 'grid', 'slug' => 'solutions']),
                        ],
                    ]
                ],
                [
                    'name' => 'Store',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('store.index'),
                ],
                [
                    'name' => 'Articles',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('posts.index', ['grid_type' => 'grid', 'slug' => 'articles']),
                ],
                [
                    'name' => 'Support',
                    'type' => Menu::ITEM_TYPE_ROUTE_DROPDOWN,
                    'array' => [
                        [
                            'name' => 'Downloads',
                            'url' => route('downloads'),
                        ],
                        [
                            'name' => 'FAQ',
                            'url' => route('faq')
                        ]
                    ],
                ],
                [
                    'name' => 'About Us',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('about'),
                ],
                [
                    'name' => '<i class="bi bi-globe2"></i>',
                    'type' => Menu::ITEM_TYPE_LANG_SWITCHER,
                ],
                [
                    'name' => '<i class="bi bi-telephone"></i>&nbsp;Contact Us',
                    'type' => Menu::ITEM_TYPE_CALL_US_BTN,
                    'tel' => '+9647503807676',
                ]
            ],
        ]);

        $storeMenu = Menu::create([
            'name' => 'Store Main Menu',
            'code' => 'store_main_menu',
            'items' => [
                [
                    'name' => 'Home',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('home'),
                ],

                [
                    'name' => 'Store',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('store.index'),
                ],
                [
                    'name' => 'Products',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('store.products.index'),
                ],
                [
                    'name' => 'My Account',
                    'type' => Menu::ITEM_TYPE_USER_ACCOUNT,
                ],

            ],
        ]);

        $storeMenuWithCart = Menu::create([
            'name' => 'Store Menu',
            'code' => 'store_menu',
            'items' => [
                [
                    'name' => 'Home',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('home'),
                ],

                [
                    'name' => 'Store',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('store.index'),
                ],
                [
                    'name' => 'Products',
                    'type' => Menu::ITEM_TYPE_ROUTE,
                    'url' => route('store.products.index'),
                ],
                [
                    'name' => '',
                    'type' => Menu::ITEM_TYPE_LIVEWIRE_CART,
                ],
                [
                    'name' => 'My Account',
                    'type' => Menu::ITEM_TYPE_USER_ACCOUNT,
                ],

            ],
        ]);


    }
}
