<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EnabledCountry;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            TimeNetPaymentMethodSeeder::class, //Payment Methods
            TimeNetCountrySeeder::class, //Countries
            TimeNetRoleSeeder::class
        ]);



        $user = User::factory()->create([
            'name' => 'TimeNet Admin',
            'email' => 'yad@gmail.com',
            'phone_number' => '+9647507534867',
            'lc_country_id' => EnabledCountry::COUNTRY_IRAQ,
            'password' => bcrypt('newpassword'),
        ]);

//        User::factory(100)->create([
//            'lc_country_id' => EnabledCountry::COUNTRY_IRAQ,
//        ]);

        $user->assignRole('admin');
        //1
        $postProductCatalogCategory = \App\Models\Category::factory([
            'name' => 'Product Catalog',
            'model' => Post::class,
        ])->create();
        //2
        $postServiceCategory = \App\Models\Category::factory([
            'name' => 'Services',
            'model' => Post::class,
        ])->create();

        //3
        $postSolutionCategory = \App\Models\Category::factory([
            'name' => 'Solutions',
            'model' => Post::class,
        ])->create();

        //4
        $postArticleCategory = \App\Models\Category::factory([
            'name' => 'Articles',
            'model' => Post::class,
        ])->create();

        //5
        $postFeaturesCategory = \App\Models\Category::factory([
            'name' => 'Features',
            'model' => Post::class,
        ])->create();


//        Post::factory(14)->create([
//            'category_id' => $postSolutionCategory->id,
//        ]);

//        Post::factory(14)->create([
//            'category_id' => $postProductCatalogCategory->id,
//        ]);


//        $posts = Post::whereIn('category_id', [$postProductCatalogCategory->id, $postSolutionCategory->id])->get();
//
//        foreach ($posts as $post) {
//
//            $path = public_path('images/examples/900x660.jpg');
//
//            $post->addMedia($path)
//                ->preservingOriginal()
//                ->toMediaCollection('cover');
//        }

        $this->call([


            TimeNetBrandSeeder::class, //Brands
            TimeNetProductSeeder::class, //Products
            TimeNetServiceSeeder::class, //Services
            TimeNetFeatureSeeder::class, //Services
            TimeNetArticleSeeder::class, //Articles
            TimeNetMenuSeeder::class, //Articles
            TimeNetTeamMemberSeeder::class, //Team Members
            TimeNetFakeFAQSeeder::class,
            TimeNetDefaultWebsiteThemeSeeder::class,
        ]);

//        Order::factory(100)->create();



    }
}
