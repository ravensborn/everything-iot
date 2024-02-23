<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($postSlug)
    {

        $post = Post::where('slug', $postSlug)->firstOrFail();


        $validated = \request()->validate([
            'content' => 'required|min:3|max:2500'
        ]);

        $validated['post_id'] = $post->id;
        $validated['user_id'] = auth()->user()->id;

//        $validated['is_approved'] = true;

        Comment::create($validated);

        return redirect()->to(back()->getTargetUrl() . '#comments_form')->with([
            'comment_created' => true
        ]);

    }
}
