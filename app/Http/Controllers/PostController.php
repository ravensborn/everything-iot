<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\WebsiteTheme;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index($grid_type = 'grid', $slug = '')
    {
        if ($slug) {

            $category = Category::where('slug', $slug)->first();

            $posts = Post::where('category_id', $category->id)
                ->where('is_hidden', false)
                ->paginate(12);

            return view('pages.posts.index', [
                'posts' => $posts,
                'category' => $category,
                'grid_type' => $grid_type
            ]);
        }

         abort(404);
    }


    public function show($slug)
    {

        if (auth()->check() && auth()->user()->hasRole('admin')) {

            $post = Post::where('slug', $slug)->firstOrFail();
        } else {
            $post = Post::where('slug', $slug)->where('is_hidden', false)->firstOrFail();
        }


        visitor()->visit($post);

        $comments = collect();

        if ($post->is_commentable) {
            $comments = $post->approved_comments;
        }

        $related_posts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(4)
            ->inRandomOrder()
            ->get();

        $categories = Category::whereIn('model', [Post::class, Product::class])->get();
        $selectedWebsiteTheme = WebsiteTheme::where('is_selected', true)->first();

        $articleSideImages = collect();

        if ($selectedWebsiteTheme) {
            $articleSideImages = $selectedWebsiteTheme->getMedia('article_side_images');
        }

        $openGraphData = [
            'title' => $post->title,
            'image' => $post->getFirstMediaUrl('cover') ?? asset('images/logo-dark.png'),
            'description' => 'Read more on TimeNet website.',
            'url' => url()->current(),
        ];

        return view('pages.posts.show', [
            'post' => $post,
            'comments' => $comments,
            'related_posts' => $related_posts,
            'categories' => $categories,
            'article_side_images' => $articleSideImages,
            'openGraphData' => $openGraphData
        ]);

    }
}
