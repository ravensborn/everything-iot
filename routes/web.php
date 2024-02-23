<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Store\Index as LivewireStoreIndex;
use App\Http\Livewire\Store\Products\Index as LivewireStoreProductIndex;
use App\Http\Livewire\Store\Products\Show as LivewireStoreProductShow;
use App\Http\Livewire\Store\CartItems\Index as LivewireStoreCartItemIndex;
use App\Http\Livewire\Store\Checkout\Index as LivewireStoreCheckoutIndex;

use App\Http\Livewire\Users\Account\Overview as LivewireUserAccountOverview;
use App\Http\Livewire\Users\Account\Security as LivewireUserAccountSecurity;
use App\Http\Livewire\Users\Account\Notifications as LivewireUserAccountNotifications;
use App\Http\Livewire\Users\Account\Preferences as LivewireUserAccountPreferences;
use App\Http\Livewire\Users\Store\OrdersIndex as LivewireUserStoreOrdersIndex;
use App\Http\Livewire\Users\Store\OrdersShow as LivewireUserStoreOrdersShow;
use App\Http\Livewire\Users\Store\Wishlist as LivewireUserStoreWishlist;


//Home route

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

//Static page routes
Route::get('/support', [PageController::class, 'support'])
    ->name('support');

Route::post('/support-send-email', [PageController::class, 'supportEmail'])
    ->name('support-send-email');


Route::get('/faq', [PageController::class, 'faq'])
    ->name('faq');
Route::get('/downloads', [PageController::class, 'downloads'])
    ->name('downloads');
Route::get('/coming-soon', [PageController::class, 'soon'])
    ->name('soon');
Route::get('/about-us', [PageController::class, 'about'])
    ->name('about');

Route::get('/privacy-and-policy', [PageController::class, 'privacyAndPolicy'])
    ->name('privacy-and-policy');

Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions'])
    ->name('terms-and-conditions');

Route::get('/banned', [PageController::class, 'banned'])
    ->middleware('auth')
    ->name('user-banned');



Route::get('/set-language/{locale}', function (string $locale) {

    if (!in_array($locale, ['en', 'ku', 'ar'])) {
        abort(400);
    }

    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();

})->name('set-language');


//Register, login, and logout
Auth::routes([
    'logout' => false,
]);


Route::get('/logout', function () {
    auth()->logout();

    return redirect()->route('home');

})->name('logout');


//Verify user email Routes

Route::middleware(['auth'])->group(function () {

    Route::get('/email/verify', [VerifyEmailController::class, 'notice'])
        ->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');


    Route::post('/email/verification-notification', [VerifyEmailController::class, 'send'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});


//Store routes

Route::get('/store', LivewireStoreIndex::class)->name('store.index');
Route::get('/store/products', LivewireStoreProductIndex::class)->name('store.products.index');
Route::get('/store/products/{slug}', LivewireStoreProductShow::class)->name('store.products.show');


Route::middleware(['auth', 'verified'])->group(function () {

    //Cart and checkout routes
    Route::get('/store/cart', LivewireStoreCartItemIndex::class)
        ->name('store.cartItems.index');
    Route::get('/store/checkout', LivewireStoreCheckoutIndex::class)
        ->name('store.checkout.index');


    //User account setting routes
    Route::get('/user/account/overview', LivewireUserAccountOverview::class)->name('users.account.overview');
    Route::get('/user/account/security', LivewireUserAccountSecurity::class)->name('users.account.security');
    Route::get('/user/account/notifications', LivewireUserAccountNotifications::class)->name('users.account.notifications');
    Route::get('/user/account/preferences', LivewireUserAccountPreferences::class)->name('users.account.preferences');
    Route::get('/user/store/wishlist', LivewireUserStoreWishlist::class)->name('users.store.wishlist');
    Route::get('/user/store/orders', LivewireUserStoreOrdersIndex::class)->name('users.store.orders.index');
    Route::get('/user/store/orders/{order}', LivewireUserStoreOrdersShow::class)->name('users.store.orders.show');
    Route::get('/user/store/orders/{order}/invoice', [InvoiceController::class, 'show'])->name('users.store.orders.invoice');

});


//Post routes
Route::get('/posts/{grid_type}/{slug}', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{slug}', [PostController::class, 'show'])
    ->name('posts.show');

Route::post('/posts/{slug}/comment', [CommentController::class, 'store'])
    ->name('posts.comments.store')
    ->middleware(['auth', 'verified']);

//Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['role:admin|moderator'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.overview');


        Route::get('/dashboard/products', [DashboardController::class, 'productsIndex'])
            ->name('dashboard.products.index');

        Route::get('/dashboard/products/create', [DashboardController::class, 'productsCreate'])
            ->name('dashboard.products.create');

        Route::get('/dashboard/products/{slug}/edit', [DashboardController::class, 'productsEdit'])
            ->name('dashboard.products.edit');

        Route::get('/dashboard/products/{product}/media-manager', [DashboardController::class, 'productsMediaManager'])
            ->name('dashboard.products.media-manager');

        Route::get('/dashboard/posts', [DashboardController::class, 'postsIndex'])
            ->name('dashboard.posts.index');

        Route::get('/dashboard/posts/create', [DashboardController::class, 'postsCreate'])
            ->name('dashboard.posts.create');

        Route::get('/dashboard/posts/{slug}/edit', [DashboardController::class, 'postsEdit'])
            ->name('dashboard.posts.edit');

        Route::get('/dashboard/posts/{slug}/media-manager', [DashboardController::class, 'postsMediaManager'])
            ->name('dashboard.posts.media-manager');

        Route::post('/dashboard/posts/{slug}/upload', [DashboardController::class, 'postsMediaUpload'])
            ->name('dashboard.posts.upload');

        Route::get('/dashboard/comments', [DashboardController::class, 'commentsIndex'])
            ->name('dashboard.comments.index');

        Route::get('/dashboard/comments/create', [DashboardController::class, 'commentsCreate'])
            ->name('dashboard.comments.create');

        Route::get('/dashboard/comments/{slug}/edit', [DashboardController::class, 'commentsEdit'])
            ->name('dashboard.comments.edit');


    });

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/dashboard/users', [DashboardController::class, 'usersIndex'])
            ->name('dashboard.users.index');

        Route::get('/dashboard/users/{user}', [DashboardController::class, 'usersShow'])
            ->name('dashboard.users.show');

        Route::get('/dashboard/users/{user}/edit', [DashboardController::class, 'usersEdit'])
            ->name('dashboard.users.edit');


        Route::get('/dashboard/orders', [DashboardController::class, 'ordersIndex'])
            ->name('dashboard.orders.index');

        Route::get('/dashboard/orders/{order}', [DashboardController::class, 'ordersShow'])
            ->name('dashboard.orders.show');

        Route::get('/dashboard/categories', [DashboardController::class, 'categoriesIndex'])
            ->name('dashboard.categories.index');

        Route::get('/dashboard/categories/create', [DashboardController::class, 'categoriesCreate'])
            ->name('dashboard.categories.create');

        Route::get('/dashboard/categories/{slug}/edit', [DashboardController::class, 'categoriesEdit'])
            ->name('dashboard.categories.edit');

        Route::get('/dashboard/brands', [DashboardController::class, 'brandsIndex'])
            ->name('dashboard.brands.index');

        Route::get('/dashboard/brands/create', [DashboardController::class, 'brandsCreate'])
            ->name('dashboard.brands.create');

        Route::get('/dashboard/brands/{slug}/edit', [DashboardController::class, 'brandsEdit'])
            ->name('dashboard.brands.edit');

        Route::get('/dashboard/partners', [DashboardController::class, 'partnersIndex'])
            ->name('dashboard.partners.index');

        Route::get('/dashboard/partners/create', [DashboardController::class, 'partnersCreate'])
            ->name('dashboard.partners.create');

        Route::get('/dashboard/partners/{partner}/edit', [DashboardController::class, 'partnersEdit'])
            ->name('dashboard.partners.edit');

        Route::get('/dashboard/promo-codes', [DashboardController::class, 'promoCodeIndex'])
            ->name('dashboard.promo-codes.index');

        Route::get('/dashboard/promo-codes/create', [DashboardController::class, 'promoCodeCreate'])
            ->name('dashboard.promo-codes.create');


        Route::get('/dashboard/menu-builder', [DashboardController::class, 'menuBuilderIndex'])
            ->name('dashboard.menu-builder.index');

        Route::get('/dashboard/menu-builder/{menu}/edit', [DashboardController::class, 'menuBuilderEdit'])
            ->name('dashboard.menu-builder.edit');


        Route::get('/dashboard/team-members', [DashboardController::class, 'teamMemberIndex'])
            ->name('dashboard.team-members.index');

        Route::get('/dashboard/team-members/create', [DashboardController::class, 'teamMemberCreate'])
            ->name('dashboard.team-members.create');

        Route::get('/dashboard/team-members/{teamMember}/edit', [DashboardController::class, 'teamMemberEdit'])
            ->name('dashboard.team-members.edit');

        Route::get('/dashboard/download-center', [DashboardController::class, 'downloadCenterIndex'])
            ->name('dashboard.download-center.index');

        Route::get('/dashboard/download-center/create', [DashboardController::class, 'downloadCenterCreate'])
            ->name('dashboard.download-center.create');

        Route::get('/dashboard/faq-items', [DashboardController::class, 'faqItemIndex'])
            ->name('dashboard.faq-items.index');

        Route::get('/dashboard/faq-items/create', [DashboardController::class, 'faqItemCreate'])
            ->name('dashboard.faq-items.create');

        Route::get('/dashboard/faq-items/{faq_item}/edit', [DashboardController::class, 'faqItemEdit'])
            ->name('dashboard.faq-items.edit');

        Route::get('/dashboard/subscriber-list', [DashboardController::class, 'subscriberListIndex'])
            ->name('dashboard.subscriber-list.index');

        Route::get('/dashboard/subscriber-list-download', [DashboardController::class, 'subscriberListDownload'])
            ->name('dashboard.subscriber-list.download');

        Route::get('/dashboard/website-theme', [DashboardController::class, 'manageWebsiteThemeIndex'])
            ->name('dashboard.manage-website-theme.index');

        Route::get('/dashboard/support-request-items', [DashboardController::class, 'supportRequestItems'])
            ->name('dashboard.support-request-items');

        Route::get('/dashboard/visitor-log-download', [DashboardController::class, 'visitorLogDownload'])
            ->name('dashboard.visitor-log-download');


    });

});



