<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\FaqItem;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use App\Models\SubscriberList;
use App\Models\SupportRequestItem;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use Shetabit\Visitor\Models\Visit;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {

        $orders = Order::all();

        $statistics = [
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Homepage visits',
                'data' => number_format(Visit::where('url', route('home'))->count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'System Orders',
                'data' => number_format($orders->count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Pending Orders',
                'data' => number_format($orders->where('status', Order::STATUS_PENDING)->count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Unapproved Comments',
                'data' => number_format(Comment::where('is_approved', false)->count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Products',
                'data' => number_format(Product::count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Posts',
                'data' => number_format(Post::count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Unread Support Letters',
                'data' => number_format(SupportRequestItem::where('read', false)->count()),
            ],
            [
                'icon' => 'bi bi-clipboard-data',
                'name' => 'Subscribers',
                'data' => number_format(SubscriberList::count()),
            ],
        ];
        return view('pages.dashboard.overview', [
            'statistics' => $statistics
        ]);
    }

    public function usersIndex()
    {
        return view('pages.dashboard.users.index');
    }

    public function usersShow(User $user)
    {

        $activity = Activity::where('causer_type', User::class)
            ->where('subject_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.dashboard.users.show', [
            'activity' => $activity,
            'user' => $user
        ]);
    }

    public function usersEdit(User $user)
    {

        return view('pages.dashboard.users.edit', [
            'user' => $user
        ]);
    }

    public function ordersIndex()
    {
        return view('pages.dashboard.orders.index');
    }

    public function ordersShow(Order $order)
    {
        return view('pages.dashboard.orders.show', [
            'order' => $order
        ]);
    }

    public function productsIndex()
    {
        return view('pages.dashboard.products.index');
    }

    public function productsCreate()
    {
        return view('pages.dashboard.products.create');
    }

    public function productsEdit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('pages.dashboard.products.edit', [
            'product' => $product
        ]);
    }

    public function productsMediaManager(Product $product)
    {
        return view('pages.dashboard.products.media-manager', [
            'product' => $product,
        ]);
    }

    public function postsIndex()
    {
        return view('pages.dashboard.posts.index');
    }

    public function postsCreate()
    {
        return view('pages.dashboard.posts.create');
    }

    public function postsEdit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('pages.dashboard.posts.edit', [
            'post' => $post
        ]);
    }

    public function postsMediaManager($slug)
    {

        $post = Post::where('slug', $slug)->firstOrFail();

        return view('pages.dashboard.posts.media-manager', [
            'post' => $post,
        ]);
    }

    public function postsMediaUpload($slug): \Illuminate\Http\JsonResponse
    {

        request()->validate([
            'file' => 'required|image|max:2048'
        ]);

        $file = \request()->file('file');

        $post = Post::where('slug', $slug)->firstOrFail();
        $name = time() . '_' . Str::random(5);
        $media = $post->addMedia($file)
            ->usingName($name)
            ->usingFileName($name . '.' . $file->getClientOriginalExtension())
            ->toMediaCollection('images');

        return response()->json([
            'location' => $media->getFullUrl()
        ], 200);
    }


    public function categoriesIndex()
    {
        return view('pages.dashboard.categories.index');
    }

    public function categoriesCreate()
    {
        return view('pages.dashboard.categories.create');
    }

    public function categoriesEdit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('pages.dashboard.categories.edit', [
            'category' => $category
        ]);
    }


    public function brandsIndex()
    {
        return view('pages.dashboard.brands.index');
    }

    public function brandsCreate()
    {
        return view('pages.dashboard.brands.create');
    }

    public function brandsEdit($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        return view('pages.dashboard.brands.edit', [
            'brand' => $brand
        ]);
    }


    public function partnersIndex()
    {
        return view('pages.dashboard.partners.index');
    }

    public function partnersCreate()
    {
        return view('pages.dashboard.partners.create');
    }

    public function partnersEdit(Partner $partner)
    {

        return view('pages.dashboard.partners.edit', [
            'partner' => $partner
        ]);
    }

    public function commentsIndex()
    {
        return view('pages.dashboard.comments.index');
    }

    public function promoCodeIndex()
    {
        return view('pages.dashboard.promo-codes.index');
    }

    public function promoCodeCreate()
    {
        return view('pages.dashboard.promo-codes.create');
    }

    public function menuBuilderIndex()
    {
        return view('pages.dashboard.menu-builder.index');
    }

    public function menuBuilderEdit(Menu $menu)
    {
        return view('pages.dashboard.menu-builder.edit', [
            'menu' => $menu
        ]);
    }

    public function teamMemberIndex()
    {
        return view('pages.dashboard.team-members.index');
    }

    public function teamMemberCreate()
    {
        return view('pages.dashboard.team-members.create');
    }

    public function teamMemberEdit(TeamMember $teamMember)
    {
        return view('pages.dashboard.team-members.edit', [
            'teamMember' => $teamMember
        ]);
    }

    public function downloadCenterIndex()
    {
        return view('pages.dashboard.download-center.index');
    }

    public function downloadCenterCreate()
    {
        return view('pages.dashboard.download-center.create');
    }

    public function faqItemIndex()
    {
        return view('pages.dashboard.faq-items.index');
    }

    public function faqItemCreate()
    {
        return view('pages.dashboard.faq-items.create');
    }

    public function faqItemEdit(FaqItem $faqItem)
    {
        return view('pages.dashboard.faq-items.edit', [
            'faqItem' => $faqItem
        ]);
    }

    public function subscriberListIndex()
    {
        return view('pages.dashboard.subscriber-list.index');
    }

    public function subscriberListDownload()
    {
        $list = SubscriberList::all();
        return (new FastExcel($list))->download('subscriber-list-'. date('Y-m-d') .'.xlsx');
    }

    public function manageWebsiteThemeIndex() {
        return view('pages.dashboard.manage-website-theme.index');
    }

    public function supportRequestItems() {
        return view('pages.dashboard.support-request-items.index');
    }

    function visitorLogGenerator() {
        foreach (Visit::cursor() as $list) {
            yield $list;
        }
    }

    public function visitorLogDownload() {

        return (new FastExcel($this->visitorLogGenerator()))->download('visitor-log-'. date('Y-m-d') .'.xlsx');
    }


}
